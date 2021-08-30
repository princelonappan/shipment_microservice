<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DateTime;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('date_fotmat_validation', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $date = $inputs['earth_time'];
            $format = 'Y-m-d H:i:s';
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
