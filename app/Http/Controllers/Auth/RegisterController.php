<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Settings;
use App\Models\Balance;
use App\Models\Business;
use App\Models\Contact;
use App\Models\Countrysupported;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Jobs\CustomEmail;
use Illuminate\Validation\Rules\Password;
use App\Models\Devices;
use hisorange\BrowserDetect\Parser as Browser;
use Propaganistas\LaravelPhone\PhoneNumber;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $settings;
    public $currency;
    public function __construct()
    {
        $this->settings = Settings::find(1);
        $this->currency = Countrysupported::find(1)->real;
        $this->middleware('guest');
        $this->middleware('guest:user');
        if ($this->settings->google_sl == 1) {
            config()->set('services.google.client_id', $this->settings->google_ci);
            config()->set('services.google.client_secret', $this->settings->google_cs);
            config()->set('services.google.redirect', route('callback.login', ['type' => 'google']));
        }
        if ($this->settings->facebook_sl == 1) {
            config()->set('services.facebook.client_id', $this->settings->facebook_ci);
            config()->set('services.facebook.client_secret', $this->settings->facebook_cs);
            config()->set('services.facebook.redirect', route('callback.login', ['type' => 'facebook']));
        }
    }

    public function index($referral = null)
    {
        return view('auth.register', ['title' => 'Register', 'referral' => $referral]);
    }

    public function redirectLogin($type)
    {
        if ($this->settings->registration == 0) {
            return back()->with('alert', __('Registration is currently unavailable, please try again later'))->withInput();
        }
        if ($type == "google") {
            return Socialite::driver('google')->setScopes(['openid', 'email'])->stateless()->redirect();
        } else if ($type == "facebook") {
            return Socialite::driver('facebook')->redirect();
        }
    }

    public function callbackLogin($type)
    {
        try {
            $user = Socialite::driver(($type == 'google') ? 'google' : 'facebook')->with(['access_type' => 'offline'])->stateless()->user();
            if (User::where('social_account_id', $user->id)->first()) {
                $user = User::where('social_account_id', $user->id)->first();
                Auth::guard('user')->login($user);
                try {
                    $mac = $this->macAddress();
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

                $user->update([
                    'last_login' => Carbon::now(),
                    'ip_address' => user_ip(),
                    'otp_required' => 'off',
                    'email_time' => Carbon::now(),
                    'verification_code' => randomNumber(6),
                    'email_auth' => Str::random(30),
                    'token_expired' => Carbon::now()->addMinutes(5)
                ]);

                if (user_ip() != $user->ip_address && filter_var(user_ip(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) == true && $user->login_alert == 1) {
                    dispatch(new SendEmail($user->email, $user->business->name, 'Successful Sign-In from IP address ' . user_ip(), '<h3>Did You Login from a New Location?</h3><br>We noticed your ' . $this->settings->site_name . ' account ' . $user->email . ' was just accessed from a new IP address <br><b> ' . user_ip() . '</b><br> If this was you, please you can ignore this message or reset your account password. <br><br><a href=' . route('user.password.request') . '>' . route('user.password.request') . '</a><br><br><i>This is an automated message please do not reply.</i>', null, null, 1));
                }

                App::setLocale($user->language);
                session()->put('locale', $user->language);
                return redirect()->route('user.dashboard');
            } else {
                if ($this->settings->registration == 0) {
                    return back()->with('alert', __('Registration is currently unavailable, please try again later'))->withInput();
                }
                $newUser = User::create([
                    'merchant_id' => Str::random(6),
                    'first_name' => ucwords(strtolower($user->first_name)),
                    'last_name' => ucwords(strtolower($user->last_name)),
                    'country_id' => Countrysupported::first()->id,
                    'ip_address' => user_ip(),
                    'last_login' => Carbon::now(),
                    'email_time' => Carbon::now(),
                    'phone_time' => Carbon::now(),
                    'kyc_type' => $this->settings->lithic_mode,
                    'email' => $user->email,
                    'email_verify' => 1,
                    'social_account' => ($type == 'google') ? 'google' : 'facebook',
                    'social_account_id' => $user->id,
                ]);

                if (!Contact::whereEmail($newUser->email)->exists()) {
                    $contact = Contact::create([
                        'user_id' => $newUser->id,
                        'first_name' => $newUser->first_name,
                        'last_name' => $newUser->last_name,
                        'mobile' => $newUser->phone,
                        'email' => $newUser->email,
                    ]);
                    $newUser->update(['contact_id' => $contact->id]);
                }

                $business = Business::create([
                    'user_id' => $newUser->id,
                    'name' => $newUser->first_name . ' ' . $newUser->last_name,
                    'reference' => randomNumber(7),
                ]);

                $newUser->update(['business_id' => $business->reference]);

                try {
                    $mac = $this->macAddress();
                    Devices::create(
                        [
                            'user_id' => $newUser->id,
                            'business_id' => $newUser->business_id,
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
                            'mac_address' => $mac,
                        ]
                    );
                } catch (\Exception $e) {
                    createAudit('Could not log Mac address', $newUser);
                }

                foreach (getAcceptedCountry() as $val) {
                    Balance::create([
                        'user_id' => $newUser->id,
                        'country_id' => $val->id,
                        'ref_id' => Str::uuid(),
                        'business_id' => $business->reference,
                        'main' => ($val->id == $newUser->country_id) ? 1 : 0,
                        'short_code' => $val->real->currency,
                    ]);
                }
                dispatch(new CustomEmail('welcome_message', $newUser->id));

                if (Auth::guard('user')->login($newUser)) {
                    return redirect()->route('user.dashboard');
                }
            }
        } catch (\Exception $e) {
            return back()->with('alert', $e->getMessage());
        }
    }

    public function submitregister(Request $request)
    {
        if ($this->settings->maintenance == 1) {
            return back()->with('alert', __('We are currently under maintenance, please try again later'))->withInput();
        }
        if ($this->settings->registration == 0) {
            return back()->with('alert', __('Registration is currently unavailable, please try again later'))->withInput();
        }
        $rules = [
            'username' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'g-recaptcha-response' => [($this->settings->recaptcha == 1) ? 'required' : 'nullable', 'recaptchav3:login,0.5'],
            'terms' => 'required',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'password' => ['required', Password::defaults()],
            'phone' => 'required|phone:'.strtoupper($request->code),
        ];
        $validator = Validator::make($request->all(), $rules, [
            'g-recaptcha-response' => [
                'recaptchav3' => 'Captcha error message',
            ],
            'phone.required' => 'Phone number is required',
            'phone.phone' => 'Invalid phone number',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::create([
            'merchant_id' => Str::random(6),
            'first_name' => ucwords(strtolower($request->first_name)),
            'last_name' => ucwords(strtolower($request->last_name)),
            'mobile_code' => strtoupper($request->code),
            'country_id' => Countrysupported::first()->id,
            'ip_address' => $request->ip(),
            'last_login' => Carbon::now(),
            'email_time' => Carbon::now(),
            'phone_time' => Carbon::now(),
            'phone' => PhoneNumber::make($request->phone, strtoupper($request->code))->formatE164(),
            'email' => $request->email,
            'email_verify' => 0,
            'email_auth' => Str::random(30),
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('username') && $this->settings->referral) {
            if (User::whereMerchantId($request->username)->exists() > 0) {
                $user->update([
                    'referral' => User::whereMerchantId($request->username)->first()->id,
                    'referred_date' => Carbon::now()
                ]);
            }
        }
        $contact = Contact::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'mobile' => $user->phone,
            'email' => $user->email,
        ]);
        $user->update(['contact_id' => $contact->id]);

        $business = Business::create([
            'user_id' => $user->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'reference' => randomNumber(7),
        ]);

        $user->update(['business_id' => $business->reference]);

        try {
            $mac = $this->macAddress();
            Devices::create(
                [
                    'user_id' => $user->id,
                    'business_id' => $user->business_id,
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
                    'mac_address' => $mac,
                ]
            );
        } catch (\Exception $e) {
            createAudit('Could not log Mac address', $user);
        }

        foreach (getAcceptedCountry() as $val) {
            Balance::create([
                'user_id' => $user->id,
                'country_id' => $val->id,
                'ref_id' => Str::uuid(),
                'business_id' => $business->reference,
                'main' => ($val->id == $user->country_id) ? 1 : 0,
                'short_code' => $val->real->currency,
            ]);
        }

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password,])) {
            dispatch(new CustomEmail('welcome_message', $user->id));
            dispatch(new SendEmail($user->email, $user->business->name, 'We need to verify your email address', 'Thanks you for signing up to ' . $this->settings->site_name . '.<br> As part of our securtiy checks we need to verify your email address. Simply click on the link below and job done.<br><a href="' . route('user.confirm-email', ['verify' => $user->email_auth]) . '">' . route('user.confirm-email', ['verify' => $user->email_auth]) . '</a>', null, null, 0));
            return redirect()->route('user.dashboard');
        }
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
