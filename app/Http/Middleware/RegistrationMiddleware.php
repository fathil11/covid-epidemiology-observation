<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RegistrationMiddleware
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
        if(!Auth::check()){
            return redirect()->route('login');
        }

        /** @var \App\User */
        $user = Auth::user();
        if($user->isPe() || $user->isSecondPe() || $user->isAdmin()){
            return $next($request);
        }

        return abort(403);
    }
}
