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

        if (! class_exists('CreateEventsTable')) {
            $this->publishes([
                __DIR__.'/../migrations/create_events_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_events_table.php'),
            ], 'migrations');
        }

        $this->publishes([
        __DIR__.'/../../resources/assets' => public_path('assets/Quidmye'),
    ], 'Qcalendar');
    }
}
