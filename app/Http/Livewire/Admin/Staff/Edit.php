<?php

namespace App\Http\Livewire\Admin\Staff;

use Livewire\Component;

class Edit extends Component
{
    public $val;

    protected $rules = [
        'val.first_name' => ['required', 'string', 'max:255'],
        'val.last_name' => ['required', 'string', 'max:255'],
        'val.username' => ['required', 'string', 'max:255'],
        'val.profile' => ['nullable', 'boolean'],
        'val.deposit' => ['nullable', 'boolean'],
        'val.payout' => ['nullable', 'boolean'],
        'val.promo' => ['nullable', 'boolean'],
        'val.support' => ['nullable', 'boolean'],
        'val.language' => ['nullable', 'boolean'],
        'val.news' => ['nullable', 'boolean'],
        'val.message' => ['nullable', 'boolean'],
        'val.knowledge_base' => ['nullable', 'boolean'],
        'val.email_configuration' => ['nullable', 'boolean'],
        'val.general_settings' => ['nullable', 'boolean'],
        'val.profile' => ['nullable', 'boolean'],
        'val.investment' => ['nullable', 'boolean'],
        'val.loan' => ['nullable', 'boolean'],
        'val.savings' => ['nullable', 'boolean'],
    ];

    public function mount()
    {
        $this->val->profile = (bool) $this->val->profile;
        $this->val->promo = (bool) $this->val->promo;
        $this->val->deposit = (bool) $this->val->deposit;
        $this->val->payout = (bool) $this->val->payout;
        $this->val->support = (bool) $this->val->support;
        $this->val->news = (bool) $this->val->news;
        $this->val->message = (bool) $this->val->message;
        $this->val->knowledge_base = (bool) $this->val->knowledge_base;
        $this->val->email_configuration = (bool) $this->val->email_configuration;
        $this->val->general_settings = (bool) $this->val->general_settings;
        $this->val->language = (bool) $this->val->language;
        $this->val->investment = (bool) $this->val->investment;
        $this->val->loan = (bool) $this->val->loan;
        $this->val->savings = (bool) $this->val->savings;
    }

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update(){
        $this->validate();
        $this->val->update([
            'username' => $this->val->username,
            'first_name' => $this->val->first_name,
            'last_name' => $this->val->last_name,
            'profile' => $this->val->profile,
            'deposit' => $this->val->deposit,
            'payout' => $this->val->payout,
            'promo' => $this->val->promo,
            'support' => $this->val->support,
            'news' => $this->val->news,
            'message' => $this->val->message,
            'knowledge_base' => $this->val->knowledge_base,
            'email_configuration' => $this->val->email_configuration,
            'general_settings' => $this->val->general_settings,
            'language' => $this->val->language,
            'investment' => $this->val->investment,
            'loan' => $this->val->loan,
            'savings' => $this->val->savings,
        ]);
        $this->emitUp('saved');
        $this->emit('success', __('Staff updated'));

    }

    public function render()
    {
        return view('livewire.admin.staff.edit');
    }
}
