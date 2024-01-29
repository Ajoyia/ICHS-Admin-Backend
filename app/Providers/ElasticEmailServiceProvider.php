<?php

namespace App\Providers;

use App\classes\elasticEmailDriver;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class ElasticEmailServiceProvider extends ServiceProvider
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
        Mail::extend('elastic_email', function (array $config = []) {
            return new elasticEmailDriver([
                'key'=>env('ELESTIC_EMAIL_KEY'),
            ]);
        });
    }
}
