<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;

use Auth;

class Email
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $set = Settings::find(1);
        if ($set->email_verify == 1) {
            if (auth()->guard('user')->user()->email_verify == 1) {
                return $next($request);
            } else {
                return redirect()->route('user.add-email');
            }
        } else {
            return $next($request);
        }
    }
}
