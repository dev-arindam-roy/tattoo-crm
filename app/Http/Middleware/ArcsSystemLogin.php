<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class ArcsSystemLogin
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
        // if(md5($request->root()) != 'bfc143e9d750f3d4aae180da4b07027a') {
        //     echo "Access Denied!";
        //     die; 
        // }
        return $next($request);
    }
}

