<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Jobs\SendEmail;

class OTPController extends Controller
{
    protected $user;
    protected $settings;

    public function __construct()
    {
        $this->settings = Settings::first();
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function verify()
    {
        if ($this->user->otp_required == "off") {
            return redirect()->route('user.dashboard')->with('success', __('OTP verified'));
        } else {
            return view('auth.otp', ['title' => __('OTP')]);
        }
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => ['numeric', 'required', 'min_digits:6', 'max_digits:6'],
                'g-recaptcha-response' => [($this->settings->recaptcha == 1) ? 'required' : 'nullable', 'recaptchav3:otp,0.5'],
            ],
            [
                'code.required' => __('Code is required'),
                'g-recaptcha-response' => [
                    'recaptchav3' =>  __('Captcha error message'),
                ]
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        if ($request->code == $this->user->verification_code) {
            if (Carbon::now() < $this->user->token_expired) {
                $this->user->update([
                    'otp_required' => "off"
                ]);
                createAudit(__('Verified OTP for login'));
                return redirect()->route('user.dashboard')->with('success', __('OTP verified'));
            } else {
                return back()->with('alert', __('Token Expired'))->withInput();
            }
        } else {
            return back()->with('alert', __('Invalid Code'))->withInput();
        }
    }

    public function resend()
    {
        if (Carbon::parse($this->user->email_time)->addMinutes(5) > Carbon::now()) {
            return back()->with('alert', 'You can resend link after ' . gmdate('i:s', Carbon::parse($this->user->email_time)->addMinutes(5)->diffInSeconds(Carbon::now())) . ' minutes');
        } else {
            $this->user->update([
                'email_time' => Carbon::now(),
                'verification_code' => randomNumber(6),
                'token_expired' => Carbon::now()->addMinutes(5)
            ]);
            dispatch(new SendEmail($this->user->email, $this->user->business->name, __('One Time Password'), 'Your ' . $this->settings->site_name . ' OTP is: <b>' . $this->user->verification_code . '</b>. Do not share this code with anyone.', null, null, 0));
            return redirect()->route('verify.otp')->with('success', __('OTP resent'));
        }
    }
}
