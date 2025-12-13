<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Settings;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;

class EmailController extends Controller
{
    protected $user;
    protected $settings;

    public function __construct()
    {
        $this->settings = Settings::find(1);
        $self = $this;
        $this->middleware(function (Request $request, $next) use ($self) {
            $self->user = auth()->guard('user')->user();
            return $next($request);
        });
    }

    public function add()
    {
        if ($this->user->email != null) {
            if ($this->user->email_verify == 1) {
                return redirect()->route('user.dashboard')->with('success', __('Email already verified'));
            } else {
                return redirect()->route('user.verify-email');
            }
        } else {
            return view('auth.email.index', ['title' => __('Add Email address')]);
        }
    }

    public function verify()
    {
        if ($this->user->email_verify == 1) {
            return redirect()->route('user.dashboard')->with('success', __('Email verified'));
        } else {
            return view('auth.email.verify', ['title' => __('Verify email address')]);
        }
    }

    public function sendEmail()
    {
        if (Carbon::parse($this->user->email_time)->addMinutes(5) > Carbon::now()) {
            return back()->with('alert', 'You can resend link after ' . gmdate('i:s', Carbon::parse($this->user->email_time)->addMinutes(5)->diffInSeconds(Carbon::now())) . ' minutes');
        } else {
            $code = Str::random(30);
            $this->user->update(['email_time' => Carbon::now(), 'email_auth' => $code]);
            dispatch(new SendEmail($this->user->email, $this->user->business->name, 'We need to verify your email address', 'Thanks you for signing up to ' . $this->settings->site_name . '.<br> As part of our securtiy checks we need to verify your email address. Simply click on the link below and job done.<br><a href="' . route('user.confirm-email', ['verify' => $this->user->email_auth]) . '">' . route('user.confirm-email', ['verify' => $this->user->email_auth]) . '</a>', null, null, 0));
            return back()->with('success', __('Verification Code Sent'));
        }
    }

    public function confirmEmail($verify)
    {
        if ($this->user->email_verify == 1) {
            return view('errors.error', ['title' => __('Email Verification')])->withErrors(__('Email has already been verified'));
        } else {
            if ($verify == $this->user->email_auth) {
                $this->user->update([
                    'email_verify' => 1,
                    'otp_required' => 'off',
                ]);
                return view('auth.email.success', ['title' => 'Welcome to ' . $this->settings->site_name, 'email' => $this->user->email]);
            } else {
                return view('errors.error', ['title' => __('Email Verification')])->withErrors(__('Invalid Email verification code'));
            }
        }
    }
}
