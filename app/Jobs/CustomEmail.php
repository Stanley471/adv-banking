<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Countrysupported;
use App\Models\Emailtemplate;
use App\Mail\Transaction;
use App\Jobs\SendEmail;

class CustomEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $type;
    public $customer;
    public $reason;

    public function __construct($type, $customer = null, $reason = null)
    {
        $this->type = $type;
        $this->customer = $customer;
        $this->reason = $reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    function customEmail($type, $id = null, $other = null)
    {
        $set = Settings::first();
        $currency = Countrysupported::whereid(1)->first()->real;
        $check = Emailtemplate::wheretype($type)->first();
        if ($id != null) {
            if (in_array($check->type, ['deposit_request_decline', 'card_transaction', 'withdraw_request_decline', 'new_withdraw_request_admin', 'deposit_request_approve', 'withdraw_request_approve', 'unit_purchase', 'unit_sale', 'investment_returns', 'transfer_credit', 'transfer_debit', 'loan_payment', 'savings_deposit', 'savings_return', 'savings_withdraw', 'dividend_return'])) {
                $val = Transactions::whereid($id)->first();
                $user = User::whereid($val->user_id)->first();
                $find = array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{site_name}}", "{{site_email}}", "{{reference}}", "{{reason}}");
                $replace = array($val->amount . $currency->currency, $val->charge . $currency->currency, $user->first_name, $user->last_name, $set->site_name, $set->email, $val->ref_id, $val->decline_reason);
            } else if ($check->type == "compliance_approval" || $check->type == "welcome_message") {
                $user = User::whereid($id)->first();
                $find = array("{{first_name}}", "{{last_name}}", "{{site_name}}", "{{site_email}}");
                $replace = array($user->first_name, $user->last_name, $set->site_name, $set->email);
            } else if (in_array($check->type, ['compliance_resubmit', 'loan_approved', 'loan_declined'])) {
                $user = User::whereid($id)->first();
                $find = array("{{first_name}}", "{{last_name}}", "{{site_name}}", "{{site_email}}", "{{reason}}");
                $replace = array($user->first_name, $user->last_name, $set->site_name, $set->email, $other);
            }
        }
        $mail = [
            'email' => ($check->type == "new_withdraw_request_admin") ? $set->email : $user->email,
            'name' => ($check->type == "new_withdraw_request_admin") ? $set->site_name : $user->business->name,
            'subject' => str_replace($find, $replace, $check->subject),
            'message' => str_replace($find, $replace, $check->body)
        ];
        if(!in_array($check->type, ['compliance_approval', 'compliance_resubmit', 'welcome_message', 'loan_approved', 'loan_declined'])){
            Mail::to($mail['email'], $mail['name'])->queue(new Transaction($mail['subject'], $mail['message'], Transactions::whereId($id)->first()));
        }else{
            dispatch(new SendEmail($mail['email'], $mail['name'], $mail['subject'], $mail['message'], null, null, 0));
        }
    }

    public function handle()
    {
        $this->customEmail($this->type, $this->customer, $this->reason);
    }
}
