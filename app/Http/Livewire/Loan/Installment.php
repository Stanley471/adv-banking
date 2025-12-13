<?php

namespace App\Http\Livewire\Loan;

use App\Models\Transactions;
use App\Models\Installment as Install;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Jobs\CustomEmail;
use Carbon\Carbon;

class Installment extends Component
{
    public $user;
    public $settings; 
    public $installments;

    protected $listeners = ['saved' => '$refresh'];

    public function pay($date){
        $date = Install::whereId($date)->first();
        $balance = $this->user->getFirstBalance();
        $amount = ($date->expiry_date > Carbon::today()) ? $date->payback : $date->failed;

        if ($balance->amount < $amount) {
            return $this->emit('alert', __('Insufficient balance.'));
        }

        $balance->update(['amount' => $balance->amount - $amount]);

        $date->update([
            'status' => 'paid',
            'profit' =>  $amount - $date->initial,
        ]);

        if($date->application->defaulters() == false){
            $date->application->update(['defaulter' => 0]);
        }

        if($date->application->uncompleted() == false){
            $date->application->update(['status' => 'paid']);
        }

        $debit = Transactions::create([
            'user_id' => $this->user->id,
            'installment_id' => $date->id,
            'business_id' => $this->user->business_id,
            'amount' => $amount,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'loan_payment',
            'status' => 'success',
        ]);

        $this->emit('saved');
        createAudit('Paid Loan ' .$date->application->ref_id.' '.$debit->ref_id);
        dispatch(new CustomEmail('loan_payment', $debit->id));
        //return redirect()->route('user.followed', ['type' => 'loan'])->with('success', __('Payment successful'));
    }

    public function render()
    {
        return view('livewire.loan.installment');
    }
}
