<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->role_id !=3 ){
            return $next($request);
        }
        return redirect()->route('home');
    }
}
