<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\SentEmail;
use App\Models\Transactions;
use App\Models\Units;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Email extends Component
{
    public $plan;
    public $admin;
    public $subject;
    public $message;
    public $amount;
    public $password;

    protected $listeners = ['saved' => '$refresh'];

    public function dividend()
    {
        if ($this->plan->dividend != 1) {
            $this->emit('alert', 'Dividend sharing disabled');
        }
        $admin = Admin::whereRole('super')->first();
        if (Hash::check($this->password, $admin->password)) {
            $collect = $this->plan->followed->whereNotNull('units');
            if ($collect->count()) {
                Category::create([
                    'amount' => $this->amount,
                    'type' => 'dividend',
                    'plan_id' => $this->plan->id,
                ]);
                $total = $collect->sum('units');
                foreach ($collect as $investor) {
                    $investor->update([
                        'dividend' => $investor->dividend + ($investor->units / $total * $this->amount)
                    ]);

                    $balance = $investor->user->getFirstBalance();
                    $balance->update(['amount' => $balance->amount + ($investor->units / $total * $this->amount)]);

                    //Log unit
                    $unit = Units::create([
                        'user_id' => $investor->user_id,
                        'profit_id' => $investor->id,
                        'plan_id' => $this->plan->id,
                        'units' => $investor->units,
                        'type' => 'dividend',
                        'amount' => $investor->units / $total * $this->amount,
                    ]);

                    //Dividend Return
                    $trx = Transactions::create([
                        'user_id' => $investor->user_id,
                        'profit_id' => $unit->id,
                        'business_id' => $investor->user->business_id,
                        'amount' => $investor->units / $total * $this->amount,
                        'charge' => null,
                        'ref_id' => Str::uuid(),
                        'trx_type' => 'credit',
                        'type' => 'dividend_return',
                        'status' => 'success',
                    ]);

                    dispatch(new CustomEmail('dividend_return', $trx->id));

                    createAudit('Received Dividend Return' . $trx->ref_id, $investor->user);
                }
                $this->reset(['amount', 'password']);
                $this->emit('success', 'Sending dividends');
                $this->emit('closeDrawer');
            } else {
                $this->emit('alert', 'No investors');
            }
        } elseif (!Hash::check($this->password, $admin->password)) {
            $this->addError('password', 'Invalid password');
        }
    }

    public function sendEmail()
    {
        $collect = $this->plan->followed;
        if ($collect->count() > 0) {
            if ($this->admin->promo == 0) {
                $this->emit('alert', 'Permission denied');
                return;
            }
            foreach ($collect as $contact) {
                SentEmail::create([
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'contact_id' => $contact->user->contact->id,
                    'admin_id' => $this->admin->id,
                ]);
                dispatch(new SendEmail($contact->user->contact->email, $contact->user->contact->first_name . ' ' . $contact->user->contact->last_name, $this->subject, null, $this->message, null, null, 0));
            }
            $this->reset(['subject', 'message']);
            $this->emit('success', 'Email added to queue');
            $this->emit('closeDrawer');
        } else {
            $this->emit('alert', 'No followers');
        }
    }

    public function render()
    {
        return view('livewire.admin.invest.email');
    }
}
