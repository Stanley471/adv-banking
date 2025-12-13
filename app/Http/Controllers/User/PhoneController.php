<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Countrysupported;
use Carbon\Carbon;
use App\Jobs\SendSMS;

class PhoneController extends Controller
{
    protected $user;
    protected $settings;
    public $currency;

    public function __construct()
    {
        $this->settings = Settings::first();
        $this->currency = Countrysupported::find(1)->real;
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function create(Request $request)
    {
        $rules = [
            'phone' => 'required|phone:'.$this->currency->iso2,
        ];
        $validator = Validator::make($request->all(), $rules, [
            'phone.required' => 'Phone number is required',
            'phone.phone' => 'Invalid phone number',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        $this->user->update([
            'mobile_code' => strtoupper($request->code),
            'phone' => PhoneNumber::make($request->phone, strtoupper($request->code))->formatE164(),
        ]);
        return redirect()->route('user.dashboard');
    }

    public function add()
    {
        if ($this->user->phone_verify == 1) {
            return redirect()->route('user.dashboard')->with('success', __('Phone already verified'));
        } else {
            if (Carbon::parse($this->user->phone_time)->addMinutes(5) < Carbon::now()) {
                $this->user->update([
                    'phone_time' => Carbon::now(),
                    'token_expired' => Carbon::now()->addMinutes(5),
                    'phone_code' => randomNumber(6)
                ]);
                dispatch(new SendSMS(PhoneNumber::make($this->user->phone, $this->user->mobile_code), 'Your ' . $this->settings->site_name . ' verifcation code is: ' . $this->user->mobile_code . '. Do not share this code with anyone.'));
            }
            return view('auth.phone.verify', ['title' => __('Verify Phone number')]);
        }
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => ['numeric', 'required', 'min_digits:6', 'max_digits:6'],
            ],
            [
                'code.required' => __('Code is required'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        if ($request->code == $this->user->phone_code) {
            if (Carbon::now() < $this->user->token_expired) {
                $this->user->update([
                    'phone_verify' => 1
                ]);
                return redirect()->route('user.dashboard')->with('success', __('Phone number verified'));
            } else {
                return back()->with('alert', __('Token Expired'))->withInput();
            }
        } else {
            return back()->with('alert', __('Invalid Code'))->withInput();
        }
    }

    public function resend()
    {
        if (Carbon::parse($this->user->phone_time)->addMinutes(5) > Carbon::now()) {
            return back()->with('alert', 'You can resend link after ' . gmdate('i:s', Carbon::parse($this->user->phone_time)->addMinutes(5)->diffInSeconds(Carbon::now())) . ' minutes');
        } else {
            $this->user->update([
                'phone_time' => Carbon::now(),
                'token_expired' => Carbon::now()->addMinutes(5),
                'phone_code' => randomNumber(6)
            ]);
            dispatch(new SendSMS(PhoneNumber::make($this->user->phone, $this->user->mobile_code), 'Your ' . $this->settings->site_name . ' verifcation code is: ' . $this->user->mobile_code . '. Do not share this code with anyone.'));
            return redirect()->route('user.verify-phone')->with('success', __('Verification code resent'));
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required|string',
                'g-recaptcha-response' => [($this->settings->recaptcha == 1) ? 'required' : 'nullable', 'recaptchav3:otp,0.5'],
            ],
            [
                'phone.required' => __('Phone number is required'),
                'g-recaptcha-response' => [
                    'recaptchav3' =>  __('Captcha error message'),
                ]
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        try {
            if (User::wherePhone($request->phone)->wherePhoneVerify(1)->count() == 0) {
                $this->user->update([
                    'phone_time' => Carbon::now(),
                    'phone' => PhoneNumber::make($request->phone, $this->user->getCountry()->iso2)->formatForMobileDialingInCountry($this->user->getCountry()->iso2),
                    'phone_code' => randomNumber(6),
                    'token_expired' => Carbon::now()->addMinutes(5),
                ]);
                if ($this->settings->phone_verify == 1) {
                    dispatch(new SendSMS(PhoneNumber::make($request->phone, $this->user->mobile_code), 'Your ' . $this->settings->site_name . ' verifcation code is: ' . $this->user->mobile_code . '. Do not share this code with anyone.'));
                    return redirect()->route('user.verify-phone')->with('success', __('Verification code sent'));
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                return back()->with('alert', __('Phone number has already been used for another business'));
            }
        } catch (\Propaganistas\LaravelPhone\Exceptions\NumberParseException $e) {
            return back()->with('alert', $e->getMessage())->withInput();
        } catch (\Propaganistas\LaravelPhone\Exceptions\NumberFormatException $e) {
            return back()->with('alert', $e->getMessage())->withInput();
        } catch (\Propaganistas\LaravelPhone\Exceptions\InvalidParameterException $e) {
            return back()->with('alert', $e->getMessage())->withInput();
        } catch (\Propaganistas\LaravelPhone\Exceptions\CountryCodeException $e) {
            return back()->with('alert', $e->getMessage())->withInput();
        }
    }
}
