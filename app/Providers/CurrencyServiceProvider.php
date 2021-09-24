<?php

declare(strict_types=1);

namespace App\Providers;

use App\Support\Currency\Client;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new Client([
                'base_uri' => config('NBP.nbp_web_api_url')
            ]);
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}