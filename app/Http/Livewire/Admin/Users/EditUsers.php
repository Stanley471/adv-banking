<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Business;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\SentEmail;
use App\Models\Balance;
use App\Models\Beneficiary;
use App\Models\Devices;
use App\Models\Followed;
use App\Models\Installment;
use App\Models\LoanApplicants;
use App\Models\Reply;
use App\Models\Units;
use App\Models\UserBank;
use App\Models\TemporaryFiles;
use App\Models\Transactions;
use App\Models\Savings;

class EditUsers extends Component
{
    public $val;
    public $admin;

    public function delete()
    {
        Business::whereId($this->val->id)->delete();
        Balance::whereUserId($this->val->id)->delete();
        Beneficiary::whereUserId($this->val->id)->delete();
        Devices::whereUserId($this->val->id)->delete();
        Followed::whereUserId($this->val->id)->delete();
        Installment::whereUserId($this->val->id)->delete();
        LoanApplicants::whereUserId($this->val->id)->delete();
        Reply::whereUserId($this->val->id)->delete();
        Units::whereUserId($this->val->id)->delete();
        UserBank::whereUserId($this->val->id)->delete();
        Transactions::whereUserId($this->val->id)->delete();
        Savings::whereUserId($this->val->id)->delete();
        Ticket::whereId($this->val->id)->delete();
        Contact::whereId($this->val->id)->delete();
        SentEmail::whereId($this->val->id)->delete();
        TemporaryFiles::whereUserId($this->val->id)->delete();
        $this->val->delete();
        $this->emit('success', 'User deleted');
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function render()
    {
        return view('livewire.admin.users.edit-users');
    }
}
