<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $userManagementMigrations = base_path('Modules/Usermanagement/database/migrations');
        if (is_dir($userManagementMigrations)) {
            $this->loadMigrationsFrom($userManagementMigrations);
        }
    }
}
