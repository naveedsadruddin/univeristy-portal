<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoutePermission
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
        
        $route = $request->route()->getName();
        $allowed = auth()->user()->isAdmin() ? true : false;
        if(!$allowed){
            $allowed = auth()->user()->hasPermission($route);
        }
        return $allowed ? $next($request) : abort(403);
    }
}
