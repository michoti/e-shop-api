<?php

namespace App\Providers;

use App\Filament\Resources\ProfileResource;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Schema::defaultStringLength(191);

        if ($this->app->environment('production')) {
          URL::forceScheme('https');
       }

       Carbon::setLocale(config('app.locale'));

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Admin Management',
                'Staff Management',
            ]);

            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()
                    ->label('Profile')
                    ->url(ProfileResource::getUrl()),
            ]);
        });
    }
}
