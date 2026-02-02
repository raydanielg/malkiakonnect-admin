<?php

namespace Modules\Authmanagement\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Authmanagement\Providers\RouteServiceProvider;

class AuthmanagementServiceProvider extends ServiceProvider
{
    protected string $name = 'Authmanagement';

    protected string $nameLower = 'authmanagement';

    public function boot(): void
    {
        $this->loadViewsFrom(base_path('Modules/Authmanagement/resources/views'), $this->nameLower);
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
