<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Models\Devices;
use hisorange\BrowserDetect\Parser as Browser;
use Symfony\Component\Process\Process;

class Login extends Component
{
    public $set;
    public $email;
    public $password;
    public $remember_me;

    public function macAddress()
    {
        $process = new Process(['arp', '-a']);
        $process->mustRun();
        $output = $process->getOutput();
        preg_match('/(?:[0-9a-fA-F]:?){12}/', $output, $matches);

        $macAddress = $matches[0] ?? null;
        return $macAddress;
    }

    public function submitLogin()
    {
        if ($this->set->maintenance == 1) {
            return $this->addError('added', 'We are currently under maintenance, please try again later');
        }

        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        $remember_me = ($this->remember_me != null) ? true : false;
        if (Auth::guard('user')->attempt(['email' => $this->email, 'password' => $this->password], $remember_me)) {
            $user = User::whereId(auth()->guard('user')->user()->id)->first();
            if ($user->status == 1) {
                Auth::guard('user')->logout();
                return $this->addError('added', __('Account Suspended'));
            }
            try {
                $mac = $this->macAddress();
                $user->update([
                    'last_login' => Carbon::now(),
                    'ip_address' => user_ip(),
                    'otp_required' => (($user->fa_status == 0 || $user->email_verify == 1) && $mac != $user->lastMac()->mac_address) ? 'on' : 'off',
                    'email_time' => Carbon::now(),
                    'verification_code' => randomNumber(6),
                    'token_expired' => Carbon::now()->addMinutes(5)
                ]);
                Devices::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'business_id' => $user->business_id,
                        'mac_address' => $mac
                    ],
                    [
                        'userAgent' => Browser::userAgent(),
                        'deviceType' => Browser::deviceType(),
                        'browserName' => Browser::browserName(),
                        'platformName' => Browser::platformName(),
                        'deviceFamily' => Browser::deviceFamily(),
                        'browserFamily' => Browser::browserFamily(),
                        'browserVersion' => Browser::browserVersion(),
                        'platformFamily' => Browser::platformFamily(),
                        'platformVersion' => Browser::platformVersion(),
                        'deviceModel' => Browser::deviceModel(),
                        'mobileGrade' => Browser::mobileGrade(),
                        'ip_address' => user_ip(),
                        'last_login' => Carbon::now(),
                    ]
                );
            } catch (\Exception $e) {
                createAudit(__('Could not log Mac address'), $user);
            }

            if ($user->otp_required == 'on') {
                dispatch(new SendEmail($user->email, $user->business->name, 'One Time Password', 'Your ' . $this->set->site_name . ' OTP is: </br><b>' . $user->verification_code . '</br></b>. Do not share this code with anyone.', null, null, 0));
            }

            if (user_ip() != $user->ip_address && filter_var(user_ip(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) == true && $user->login_alert == 1) {
                dispatch(new SendEmail($user->email, $user->business->name, 'Successful Sign-In from IP address ' . user_ip(), '<h3>Did You Login from a New Location?</h3><br>We noticed your ' . $this->set->site_name . ' account ' . $user->email . ' was just accessed from a new IP address <br><b> ' . user_ip() . '</b><br> If this was you, please you can ignore this message or reset your account password. <br><br><a href=' . route('user.password.request') . '>' . route('user.password.request') . '</a><br><br><i>This is an automated message please do not reply.</i>', null, null, 1));
            }

            App::setLocale($user->language);
            session()->put('locale', $user->language);
            if (session()->has('url.intended')) {
                if (strpos(session('url.intended'), 'user') !== false) {
                    return redirect()->intended();
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return redirect()->route('user.dashboard');
            }
            return redirect()->route('user.dashboard');
        } else {
            $this->emit('wrongPassword');
            return $this->addError('added', 'Oops! You have entered invalid credentials');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
