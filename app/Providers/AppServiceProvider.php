<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\User;
use App\Models\Countrysupported;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->uncompromised();
        });
        View::composer('*', function ($view) {
            $set = Settings::first();
            config()->set('recaptchav3.secret', $set->NOCAPTCHA_SECRET);
            config()->set('recaptchav3.sitekey', $set->NOCAPTCHA_SITEKEY);
            if (Auth::guard('admin')->check()) {
                $view->with('admin', Admin::find(Auth::guard('admin')->user()->id));
            }
            if (Auth::guard('user')->check()) {
                $view->with('user', User::find(Auth::guard('user')->user()->id));
            }
            $view->with('currency', Countrysupported::find(1)->real);
            $view->with('set', $set);
            
            if(url()->current()!=route('ipn.boompay')){
                //sub_check();
            }   
        });
    }
}
