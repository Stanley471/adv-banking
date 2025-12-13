<?php

namespace App\Http\Livewire\Admin\Deposit;

use Livewire\Component;
use App\Jobs\CustomEmail;

class Details extends Component
{
    public $val;
    public $type;
    public $admin;
    public $reason;

    public function approve()
    {
        if($this->val->status != 'success'){
            $this->val->update([
                'status' => 'success',
                'staff_id' => $this->admin->id
            ]);
    
            $balance = $this->val->user->getFirstBalance();
            $balance->update(['amount' => $balance->amount + $this->val->amount - $this->val->charge]);
                
            dispatch(new CustomEmail('deposit_request_approve', $this->val->id));
            createAudit('Deposit request approved ' . $this->val->id, $this->val->user);
            $this->emit('saved');
            $this->emit('success', 'Transaction approved');
            $this->emit('closeDrawer');
        }else{
            $this->emit('alert', 'Already approved');
        }
    }

    public function decline()
    {
        $this->validate([
            'reason' => ['required']
        ]);
        $this->val->update([
            'status' => 'declined', 
            'declined_reason' => $this->reason,
            'staff_id' => $this->admin->id
        ]);
            
        dispatch(new CustomEmail('deposit_request_decline', $this->val->id, $this->reason));
        createAudit('Deposit request Declined ' . $this->val->id, $this->val->user);
        $this->reset(['reason']);
        $this->emit('saved');
        $this->emit('success', 'Transaction declined');
        $this->emit('closeDrawer');
    }

    public function render()
    {
        return view('livewire.admin.deposit.details');
    }
}
