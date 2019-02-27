<?php

namespace Quidmye\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{


    public function register()
    {
        //
    }


    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'Qcalendar');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->publishes([
        __DIR__.'/../../resources/assets' => public_path('assets/Quidmye'),
    ], 'Qcalendar');
    }
}
