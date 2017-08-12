<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('solr_listings', function(){

            $config = [
                'endpoint' => [
                    'localhost' => [
                        'host' => '192.168.10.10',
                        'port' => '8983',
                        'path' => '/solr/',
                        'core' => 'listings'
                    ]
                ]
            ];

            return new Client($config);
        });
    }
}
