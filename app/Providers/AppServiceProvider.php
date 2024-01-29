<?php

namespace App\Providers;

use App\classes\emailSender;
use App\classes\infobipDriver;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Mail;
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
        $this->app->bind(PaymentService::class,function(){
            return new PaymentService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mail::extend('infobip', function (array $config = []) {
            return new infobipDriver([
                'key'=>env('INFOBIP_KEY'),
                'data'=>'data'
            ]);
        });
    }
}
