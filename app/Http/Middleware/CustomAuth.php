<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CustomAuth
{
    /**
     * If user is admin
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, HEAD, OPTIONS, PATCH, POST, PUT, DELETE');

        if ($request->getMethod() == "OPTIONS") {
            return response('', 200);
        }

        return $next($request);
    }
}
