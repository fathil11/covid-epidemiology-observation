<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PeMiddleware
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

        switch (Auth::user()->role) {
            case '1':
                return redirect();
            break;

            case '2':
                return redirect();
            break;

            case '3':
                return $next($request);
                break;

            case '4':
                return redirect();
                break;

            default:
                return abort(501);
                break;
        }
    }
}
