<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Admin extends Middleware
{
     /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!Auth::check()) {
            return route('login');
        }
        if (Auth::user()->hasAnyRole(['admin','customer'])) {
            return $next($request);
        }
        return abort('401');
    }
}
