<?php

namespace App\Http\Livewire\Admin\Deposit;

use Livewire\Component;
use App\Models\Transactions;

class Header extends Component
{
    private $pending;
    private $success;
    private $declined;
    public $type;
    public $admin;

    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->pending = Transactions::whereStatus('pending')->whereType('deposit')->orWhere('type', 'bank_transfer')->whereStatus('pending')->count();
        $this->success = Transactions::whereStatus('success')->whereType('deposit')->orWhere('type', 'bank_transfer')->whereStatus('success')->count();
        $this->declined = Transactions::whereStatus('declined')->whereType('deposit')->orWhere('type', 'bank_transfer')->whereStatus('declined')->count();
        return view('livewire.admin.deposit.header', [
            'pending' => $this->pending,
            'success' => $this->success,
            'declined' => $this->declined
        ]);
    }
}
