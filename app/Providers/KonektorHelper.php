<?php

namespace Burung\Providers;

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
      require_once app_path('Helpers/Topsis.php');
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
