<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guest()) {
            $user = auth()->user();
            if(isset($user->locale)) {
                app()->setLocale($user->locale);
            }

            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');

        }
        $urlLogin = route('login');

        return redirect()->guest($urlLogin);
    }
}
