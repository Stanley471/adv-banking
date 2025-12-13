<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Settings;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public $settings;

    public function __construct()
    {
        $this->settings = Settings::find(1);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email', ['title' => 'Forgot password']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:rfc,dns',
            'g-recaptcha-response' => [($this->settings->recaptcha == 1) ? 'required' : 'nullable', 'recaptchav3:reset,0.5'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if (!User::whereEmail($request->email)->exists()) {
            return back()->with('success', __('Reset link will be sent if an account is found.'));
        } else {

            $user = User::whereEmail($request->email)->first();
            $code = str_random(30);
            $link = route('user.password.reset', ['token' => $code]);

            PasswordReset::create(['email' => $user->email, 'token' => $code]);

            createAudit('Sent password reset link', $user, url()->current());

            dispatch(new SendEmail($user->email, $user->business->name, 'Password Reset', "Use This Link to Reset Password: <br> <a href='" . $link . "'>" . $link . "</a>", null, null, 0));
            return back()->with('success', __('Reset link will be sent if an account is found.'));
        }
    }
}
