<?php

namespace SIAK\Providers;

use Illuminate\Support\ServiceProvider;

class KonektorHelper extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/MainPack.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
