<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider
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
        $this->configureRequests();
    }

    public function configureRequests()
    {
        if ($this->app->runningInConsole()){
            $host = $this->app['request']->getHost();
            dd($host);
            Tenant::whereDomain($host)->get();
        }
    }
}
