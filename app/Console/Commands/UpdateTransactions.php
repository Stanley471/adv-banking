<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Countrysupported;
use App\Models\Followed;
use App\Models\Installment;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Transactions;
use App\Models\Business;
use App\Models\Category;
use App\Models\Savings;
use Illuminate\Support\Str;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;

class UpdateTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:transactions';
    protected $settings;
    protected $currency;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Transaction';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->settings = Settings::find(1);
        $this->currency = Countrysupported::find(1);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

     public function getDuration($duration)
    {
        if ($duration == 'monday') {
            return Carbon::MONDAY;
        } else if ($duration == 'tuesday') {
            return Carbon::TUESDAY;
        } else if ($duration == 'wednesday') {
            return Carbon::WEDNESDAY;
        } else if ($duration == 'thursday') {
            return Carbon::THURSDAY;
        } else if ($duration == 'friday') {
            return Carbon::FRIDAY;
        } else if ($duration == 'saturday') {
            return Carbon::SATURDAY;
        } else if ($duration == 'sunday') {
            return Carbon::SUNDAY;
        }
    }
    
    public function handle()
    {
        //Pending Deposit of Payment Gateways
        foreach (Transactions::whereStatus('pending')->whereType('deposit')->get() as $val) {
            if ($val->gateway->type == 0) {
                $diff = Carbon::parse($val->created_at)->diffInHours();
                if ($diff > 1 || $diff == 1) {
                    $val->status = 'failed';
                    $val->save();
                }
            }
        }
        $this->info('Failed Deposit updated!!!');

        //Investment Returns
        foreach (Followed::whereStatus('pending')->whereRelation('plan', 'type', '=', 'project')->get() as $val) {
            if (Carbon::today() > $val->plan->expiring_date) {
                $val->update(['status' => 'success']);
                $balance = $val->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $val->amount + ($val->amount * $val->plan->interest / 100)]);

                $trx = Transactions::create([
                    'user_id' => $val->user->id,
                    'profit_id' => $val->id,
                    'business_id' => $val->user->business_id,
                    'amount' => $val->amount + ($val->amount * $val->plan->interest / 100),
                    'ref_id' => Str::uuid(),
                    'trx_type' => 'credit',
                    'type' => 'investment_returns',
                    'status' => 'success',
                ]);

                dispatch(new CustomEmail('investment_returns', $trx->id));

                $notification = notifyUser('Investment has ended', 'Profit from ' . $val->plan->name . ' has been credited to your account.', null, null, 'general');
                $val->user->notify($notification);
            }
        }
        $this->info('Investment updated!!!');

        //Regular Savings Returns
        foreach (Savings::whereJoinedStatus('pending')->whereType('regular')->get() as $val) {
            if (Carbon::today() > $val->expiry_date) {
                $val->update(['joined_status' => 'paid']);
                $balance = $val->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $val->amount + ($val->amount * $val->plan->interest / 100)]);

                $trx = Transactions::create([
                    'user_id' => $val->user->id,
                    'save_id' => $val->id,
                    'business_id' => $val->user->business_id,
                    'amount' => $val->amount + ($val->amount * $val->plan->interest / 100),
                    'ref_id' => Str::uuid(),
                    'trx_type' => 'credit',
                    'type' => 'savings_return',
                    'status' => 'success',
                ]);

                dispatch(new CustomEmail('savings_return', $trx->id));

                $notification = notifyUser('Regular savings has ended', 'Profit from ' . $val->name . ' has been credited to your account.', null, null, 'general');
                $val->user->notify($notification);
            }
        }
        $this->info('Regular Savings updated!!!');

        //Savings Circle Returns

        foreach (Category::whereType('circle')->whereDate('expiry_date', '<=', Carbon::today())->get() as $circle) {
            foreach ($circle->savings as $val) {
                $balance = $val->user->getFirstBalance();
                $balance->update(['amount' => $balance->amount + $val->amount + ($val->amount * $circle->interest / 100)]);
                $val->update(['amount' => 0]);

                $trx = Transactions::create([
                    'user_id' => $val->user->id,
                    'save_id' => $val->id,
                    'business_id' => $val->user->business_id,
                    'amount' => $val->amount + ($val->amount * $circle->interest / 100),
                    'ref_id' => Str::uuid(),
                    'trx_type' => 'credit',
                    'type' => 'savings_return',
                    'status' => 'success',
                ]);

                dispatch(new CustomEmail('savings_return', $trx->id));

                $notification = notifyUser('Saving Circle has ended', 'Profit from ' . $val->circle->name . ' has been credited to your account.', null, null, 'general');
                $val->user->notify($notification);
            }
        }
        $this->info('Savings Circle updated!!!');

        //Emergency Savings Reminder
        foreach (Savings::whereIn('type', ['emergency', 'circle'])->whereDate('reminder_month', '<=', Carbon::today())->get() as $val) {
            if($val->type == 'emergency'){
                $name = $val->name;
                $val->update(['reminder_month' => Carbon::today()->addMonth(1)->toDateString()]);
            }else{
                $name = $val->circle->name;
                $val->update(['reminder_month' => ($val->circle->circle_duration == 'weekly') ? Carbon::now()->copy()->next($this->getDuration($val->day)) : Carbon::today()->addMonth(1)->toDateString()]);
            }
            dispatch(new SendEmail($val->user->email, $val->user->business->name, 'Savings reminder', 'Hey ' . $val->user->business->name . ', this is just a friendly reminder to top up your savings plan <b>' . $name . '</b>', null, null, 0));
        }
        $this->info('Savings Reminder!!!');

        //Other Savings Returns
        foreach (Savings::where('type', '!=', 'regular')->whereDate('expiry_date', '<', Carbon::today())->get() as $val) {
            $interest = ($val->type == 'emergency') ? $this->settings->egi : $this->settings->dsi;
            $return = 0;
            $balance = $val->user->getFirstBalance();

            if (($this->settings->egg || $this->settings->dgg) && $val->transactionDeposit->whereBetween('expiry_date', [$val->expiry_date->subYear(1), $val->expiry_date])->sum('amount') >= $val->goal) {
                $balance->update(['amount' => $balance->amount + ($val->amount * $interest / 100)]);
                $return = 1;
            }

            if ($this->settings->egg == 0 || $this->settings->dgg == 0) {
                $balance->update(['amount' => $balance->amount + ($val->amount * $interest / 100)]);
                $return = 1;
            }

            $trx = Transactions::create([
                'user_id' => $val->user->id,
                'save_id' => $val->id,
                'business_id' => $val->user->business_id,
                'amount' => $val->amount * $interest / 100,
                'ref_id' => Str::uuid(),
                'trx_type' => 'credit',
                'type' => 'savings_return',
                'status' => 'success',
            ]);

            $val->update(['expiry_date' => Carbon::today()->addYear(1)->toDateString()]);

            if ($return == 1) {
                dispatch(new CustomEmail('savings_return', $trx->id));

                $notification = notifyUser(ucwords($val->type) . ' savings profit returns', 'Profit from ' . $val->name . ' has been credited to your account.', null, null, 'general');
                $val->user->notify($notification);
            }
        }
        $this->info('Other Savings updated!!!');


        //Send reminder to admin to update price unit
        foreach (Plans::whereType('mutual')->get() as $val) {
            if ($val->priceHistory->last()->date->diffInDays() <= 3 && $val->priceHistory->last()->date >= Carbon::today() && $val->reminded == 0) {
                $val->update(['reminded' => 1]);
                dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'Update Price History', $val->name . ' needs more units to be ahead, else it will be hidden from new customers and old customers will be unable to sell units at latest rates', null, null, 0));
            }
        }
        $this->info('Unit Reminder sent!!!');

        //Send loan reminder 2 days to expirying
        foreach (Installment::whereStatus('unpaid')->whereReminder(0)->get() as $val) {
            if (Carbon::parse($val->expiry_date)->diffInDays() == 2 && $val->expiry_date > Carbon::now()) {
                $val->update(['reminder' => 1]);
                dispatch(new SendEmail($val->user->email, $val->user->business->name, 'Loan payment reminder', 'Hey ' . $val->user->business->name . ' your loan payment of ' . $this->currency->currency_symbol . currencyFormat(number_format($val->amount, 2)) . ' will be due by ' . $val->expiry_date->format('M j, Y') . '. Pay early to avoid increase in interest rate after this date.', null, null, 0));
            }
        }
        $this->info('Loan Reminder sent!!!');

        //Set loan defaulters and inform admin
        foreach (Installment::whereStatus('unpaid')->whereRelation('application', 'defaulter', '=', 0)->get() as $val) {
            if ($val->expiry_date < Carbon::now()) {
                $val->application->update(['defaulter' => 1]);
                dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'Loan defaulter', $val->user->business->name . ' has failed to pay his loan, loan reference is ' . $val->application->ref_id . '. This is to inform you to take action', null, null, 0));
            }
        }
        $this->info('Loan Defaulter sent!!!');

        //Checked Expired ID
        foreach (Business::where('kyc_status', 'APPROVED')->orWhere('loan_status', 'approved')->get() as $val) {
            if ($val->kyc_expiry < Carbon::now()) {
                $val->update(['kyc_status' => 'RESUBMIT']);
                dispatch(new SendEmail($val->user->email, $val->user->business->name, 'Expired ID Document', 'Hey ' . $val->user->business->name . ' your ID document has expired, you are required to submit a recent ID document', null, null, 0));
            }
            if ($val->g_expiry < Carbon::now()) {
                $val->update(['loan_status' => 'declined', 'decline_reason' => 'Expired ID Document']);
                dispatch(new SendEmail($val->user->email, $val->user->business->name, 'Expired Guarantor ID Document', 'Hey ' . $val->user->business->name . ' your Guarantor ID document has expired, you are required to submit a recent ID document', null, null, 0));
            }
        }
        $this->info('Expired documents checked!!!');
    }
}
