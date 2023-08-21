<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */



    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::user()) {

                $user = User::find(Auth::user()->id);
                $view->with('currentUser', $user);
            }
        });
    }
}
