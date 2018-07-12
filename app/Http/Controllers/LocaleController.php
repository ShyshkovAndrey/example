<?php

namespace App\Http\Controllers;

use Config;
use Session;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {

        if (in_array($locale, Config::get('app.locales'))) {

            Session::put('locale', $locale);

        }

        return redirect()->back();
    }
}
