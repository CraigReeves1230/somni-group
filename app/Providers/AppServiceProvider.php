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
        // Listings core
        $this->app->singleton('solr_listings', function(){
            $config = [
                'endpoint' => [
                    'localhost' => [
                        'host' => env('SOLR_HOST'),
                        'port' => env('SOLR_PORT'),
                        'path' => env('SOLR_PATH'),
                        'core' => 'listings'
                    ]
                ]
            ];
            return new Client($config);
        });

        // Agents core
        $this->app->singleton('solr_agents', function(){
            $config = [
                'endpoint' => [
                    'localhost' => [
                        'host' => env('SOLR_HOST'),
                        'port' => env('SOLR_PORT'),
                        'path' => env('SOLR_PATH'),
                        'core' => 'agents'
                    ]
                ]
            ];
            return new Client($config);
        });

    }
}
