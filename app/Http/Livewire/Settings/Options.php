<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Business;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\SentEmail;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmail;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Carbon\Carbon;

class Options extends Component
{
    public $user;
    public $password;
    public $pin;
    public $fa_pin;
    public $new_password;
    public $confirm_password;
    public $set;
    public $reason;
    public $secret;
    public $image;

    public function resetPassword()
    {
        $trans = [
            'password.current_password' => 'Invalid Password'
        ];
        $this->validate([
            'password' => ['required', 'current_password:user'],
            'new_password' => ['required', Password::defaults(), 'same:confirm_password'],
            'confirm_password' => ['required', Password::defaults(), 'same:new_password'],
        ], $trans);
        $this->user->update(['password' => Hash::make($this->new_password)]);
        createAudit('Changed Password', $this->user);
        return redirect()->route('user.profile', ['type' => 'security'])->with('success', 'Password changed');
    }

    public function resetPin()
    {
        $trans = [
            'password.current_password' => 'Invalid Password'
        ];
        $this->validate([
            'password' => [($this->set->social == 0) ? 'required' : 'nullable', 'current_password:user'],
            'pin' => ['numeric', 'required', 'min_digits:4', 'max_digits:6', 'regex:/[0-9]+/'],
        ], $trans);
        $this->user->business->update(['pin' => Hash::make($this->pin)]);
        createAudit('Changed Pin', $this->user);
        return redirect()->route('user.profile', ['type' => 'security'])->with('success', 'Pin changed');
    }

    public function secondSecurity()
    {
        $this->validate([
            'fa_pin' => ['numeric', 'required', 'min_digits:6', 'max_digits:6', 'regex:/[0-9]+/'],
        ]);
        $g = new GoogleAuthenticator();
        if ($this->user->fa_status == 1) {
            if ($g->checkcode($this->user->googlefa_secret, $this->fa_pin, 3)) {
                $this->user->update([
                    'fa_status' => 0,
                    'googlefa_secret' => null,
                ]);
                createAudit(__('Deactivated 2fa'), $this->user);
                dispatch(new SendEmail($this->user->email, $this->user->business->name, __('Two Factor Security Disabled'), __('2FA security on your account was just disabled, contact us immediately if this was not done by you.'), null, null, 1));
                return redirect()->route('user.profile', ['type' => 'security'])->with('success', __('2fa disabled.'));
            } else {
                return $this->addError('fa_pin', __('Invalid code'));
            }
        } else {
            if ($g->checkcode($this->secret, $this->fa_pin, 3)) {
                $this->user->update([
                    'fa_status' => 1,
                    'googlefa_secret' => $this->secret,
                    'fa_expiring' => Carbon::now()->addHours(2)
                ]);
                createAudit(__('Activated 2fa'), $this->user);
                dispatch(new SendEmail($this->user->email, $this->user->business->name, __('Two Factor Security Enabled'), __('2FA security on your account was just enabled, contact us immediately if this was not done by you.'), null, null, 1));
                return redirect()->route('user.profile', ['type' => 'security'])->with('success', __('2fa enabled.'));
            } else {
                return $this->addError('fa_pin', __('Invalid code'));
            }
        }
    }

    public function deactivateAccount()
    {
        $trans = [
            'password.current_password' => 'Invalid Password'
        ];
        $this->validate([
            'password' => [($this->set->social == 0) ? 'required' : 'nullable', 'current_password:user'],
            'reason' => ['string', 'required', 'max:255'],
        ], $trans);
        User::whereId($this->user->id)->delete();
        Business::whereId($this->user->id)->delete();
        Ticket::whereId($this->user->id)->delete();
        Contact::whereId($this->user->id)->delete();
        SentEmail::whereId($this->user->id)->delete();
        Auth::guard('user')->logout();
        dispatch(new SendEmail($this->set->email, $this->set->site_name, 'A user just left ' . $this->set->site_name, 'Reason:' . $this->reason, null, null, 1));
        dispatch(new SendEmail($this->user->email, $this->user->first_name . ' ' . $this->user->last_name, 'Your account has been deleted', 'Your account has been deactivated, click the link below to reactivate your account <a href=' . route('reactivate', ['user' => $this->user->id]) . '>' . route('reactivate', ['user' => $this->user->id]) . '</a>', null, null, 1));
        auth()->guard('user')->logout();
        session()->forget('fakey');
        return redirect()->route('login')->with('success', 'Account was successfully deleted');
    }

    public function render()
    {
        return view('livewire.settings.options');
    }
}
