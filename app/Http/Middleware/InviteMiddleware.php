<?php

namespace App\Http\Middleware;

use Closure;
use App\Invite;

class InviteMiddleware
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
/*
        if (!$request->has('code')) {
            return redirect('/');
        }
        $token = $request->input('code');

        $invite = Invite::getInviteByToken($token);

        if (!$invite) {
            return redirect('/');
        }*/

        return $next($request);
    }
}