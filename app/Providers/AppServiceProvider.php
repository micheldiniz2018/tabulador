<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('interval_date', function($datestart, $datefinsh,$limmit)
        {

            $dateini = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($datestart)));
            $datefin = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($datefinsh)));

            $date = $dateini->diffInDays($datefin);

            if($date > $limmit)
                return false;

            // validation sucess
            return true;
        });

    }


}
