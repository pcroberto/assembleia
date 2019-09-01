<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\PautaRepositoryInterface', 'App\Repositories\PautaRepository'
        );

        $this->app->bind(
            'App\Repositories\VotacaoRepositoryInterface', 'App\Repositories\VotacaoRepository'
        );

        $this->app->bind(
            'App\Repositories\VotoRepositoryInterface', 'App\Repositories\VotoRepository'
        );
    }
}
