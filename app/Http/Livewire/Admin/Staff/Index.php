<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    private $staffs;
    public $perPage = 100;
    public $search = "";
    public $status = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $new_password;
    public $support;
    public $promo;
    public $deposit;
    public $payout;
    public $message;
    public $knowledge_base;
    public $email_configuration;
    public $general_settings;
    public $profile;
    public $news;
    public $language;
    public $investment;
    public $loan;
    public $savings;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
    }

    public function block(Admin $staff){
        $staff->update(['status' => 1]);
        $this->emit('success', __('Staff blocked'));
        $this->emitUp('saved');
    }
    
    public function unblock(Admin $staff){
        $staff->update(['status' => 0]);
        $this->emit('success', __('Staff unblocked'));
        $this->emitUp('saved');
    }

    public function resetPassword(Admin $staff){
        $staff->update(['password' => Hash::make($this->new_password)]);
        return redirect()->route('admin.staffs')->with('success', __('Password updated'));
    }

    public function addStaff()
    {
        $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:App\Models\Admin,username'],
            'password' => ['required'],
        ]);
        Admin::create([
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'password' => Hash::make($this->password),
            'profile' => $this->profile,
            'promo' => $this->promo,
            'deposit' => $this->deposit,
            'payout' => $this->payout,
            'support' => $this->support,
            'news' => $this->news,
            'message' => $this->message,
            'knowledge_base' => $this->knowledge_base,
            'email_configuration' => $this->email_configuration,
            'general_settings' => $this->general_settings,
            'language' => $this->language,
            'investment' => $this->investment,
            'loan' => $this->loan,
            'savings' => $this->savings,
        ]);
        $this->reset(['username', 'first_name', 'last_name', 'password', 'profile', 'promo', 'deposit', 'payout', 'support', 'news', 'message', 'knowledge_base', 'email_configuration', 'general_settings', 'language', 'investment', 'loan', 'savings']);
        return $this->emit('closeDrawer');
        $this->emit('success', __('Staff created'));
    }

    public function render()
    {
        $this->staffs = Admin::whereRole(null)
        ->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
        ->orderby($this->orderBy, $this->sortBy)
        ->paginate($this->perPage);
        return view('livewire.admin.staff.index', ['staffs' => $this->staffs]);
    }
}
