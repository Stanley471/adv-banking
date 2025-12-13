<?php

namespace App\Http\Livewire\Bank;

use Livewire\Component;
use App\Models\UserBank;
use App\Models\Banks;

class Index extends Component
{
    public $perPage = 100;
    public $user;
    public $settings;
    public $user_bank;
    public $acct_no;
    public $acct_name;
    public $search = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    private $bank;
    private $getBank;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addBank(){
        $this->validate([
            'user_bank' => ['required'],
            'acct_no' => ['required', 'digits_between:'.$this->settings->min_account.','.$this->settings->max_account],
            'acct_name' => ['required', 'string', 'max:255'],
        ],[
            'digits_between' => __('Account number must be between '.$this->settings->min_account.' - '.$this->settings->max_account.' numbers')
        ]);

        if(UserBank::whereBankId($this->user_bank)->whereUserId($this->user->id)->whereAcctNo($this->acct_no)->exists()){
            $this->emit('alert', 'Account already added');
        }else{
            UserBank::create([
                'user_id' => $this->user->id,
                'bank_id' => $this->user_bank,
                'acct_no' => $this->acct_no,
                'acct_name' => $this->acct_name,
            ]);
            $this->reset(['user_bank', 'acct_no', 'acct_name']);
            $this->emit('closeDrawer');
            $this->emit('success', 'Bank account added');
        }
    }

    public function render()
    {
        $this->bank = UserBank::whereUserId($this->user->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->Where('acct_no', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('bank', 'title', 'like', '%' . $this->search . '%')
                        ->orWhere('acct_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.bank.index', ['bank' => $this->bank, 'getBank' => Banks::whereStatus(1)->get()]);
    }
}
