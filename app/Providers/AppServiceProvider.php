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
        $languages = Language::where('status', 'ACTIVE')->get();
        $default_language = Language::where('default', true)->first();

        \View::share(compact('languages','default_language', 'locale' ));
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
