<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = App::getLocale();
        $default_language = Language::where('default', true)->first();
        \View::share(compact('default_language', 'locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
