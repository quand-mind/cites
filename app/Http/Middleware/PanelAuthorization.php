<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PanelAuthorization
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
        $userRole = Auth::user()->role;
        return  $userRole == 'admin'
                || $userRole == 'writer'
                || $userRole == 'superuser' ?
                $next($request) : redirect('home');
        
    }
}
