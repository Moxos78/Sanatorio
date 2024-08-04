<?php

namespace App\Providers;

use App\Models\User;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        /*Gate::before(function (user $user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
        Gate::after(function (user $user, $ability, $result, $arguments) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });*/
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['es','en']); // also accepts a closure
        });
        //
    }
}
