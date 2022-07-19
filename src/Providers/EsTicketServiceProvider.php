<?php

namespace Esperlos98\EsTicket\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class EsTicketServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        
    }
}
