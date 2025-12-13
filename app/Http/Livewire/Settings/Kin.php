<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\App;

class Kin extends Component
{
    public $user; 
    public $type; 
    public $language; 
    public $kin_first_name; 
    public $kin_last_name; 
    public $kin_email; 
    public $kin_mobile; 
    public $kin_mobile_code; 
    public $kin_address; 

    public function mount(){
        $this->kin_first_name = $this->user->business->kin_first_name;
        $this->kin_last_name = $this->user->business->kin_last_name;
        $this->kin_email = $this->user->business->kin_email;
        $this->kin_mobile = $this->user->business->kin_mobile;
        $this->kin_mobile_code = $this->user->business->kin_mobile_code;
        $this->kin_address = $this->user->business->kin_address;
        $this->language = $this->user->language;
    }

    public function profile(){

        $this->user->update([
            'language' => $this->language
        ]);
        App::setLocale($this->language);
        $this->emit('success', __('Account updated'));
    }
    
    public function save(){
        $this->validate([
            'kin_first_name' => 'required|string|max:255',
            'kin_last_name' => 'required|string|max:255',
            'kin_email' => 'required|string|email:rfc,dns',
            'kin_address' => 'required|string|max:255',
            'kin_mobile_code' => 'required|string|max:255',
            'kin_mobile' => 'required|phone:'.strtoupper($this->kin_mobile_code),
        ], [
            'kin_mobile.required' => __('Phone number is required'),
            'kin_mobile.phone' => __('Invalid phone number'),
        ]);

        $this->user->business->update([
            'kin_first_name' => ucwords(strtolower($this->kin_first_name)),
            'kin_last_name' => ucwords(strtolower($this->kin_last_name)),
            'kin_email' => $this->kin_email,
            'kin_address' => $this->kin_address,
            'kin_mobile' => PhoneNumber::make($this->kin_mobile, strtoupper($this->kin_mobile_code))->formatE164(),
            'kin_mobile_code' => $this->kin_mobile_code,
        ]);

        $this->emit('success', __('Next of Kin updated'));
    }

    public function render()
    {
        return view('livewire.settings.kin');
    }
}
