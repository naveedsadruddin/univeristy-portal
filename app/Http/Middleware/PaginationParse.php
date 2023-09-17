<?php

namespace App\Http\Middleware;

use Closure;

class PaginationParse
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
        if($request->has('page')){
            $page = $request->query('page');
            $page = intval($page);
            $request->merge(['page' => $page]);
        }
        return $next($request);
    }
}
