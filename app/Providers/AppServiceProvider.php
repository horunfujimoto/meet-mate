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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https'); //リンクをHTTPSにする設定を行う
        
        \DB::listen(function ($query) {
            \Log::info("({$query->time}) $query->sql");
            \Log::info($query->bindings);
        });
    }
}
