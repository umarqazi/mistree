<?php

namespace App\Http\Middleware;

use Config;
use Closure;
//use Tymon\JWTAuth\Middleware\GetUserFromToken;

class ConfigGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        if($model  = "Customer"){
            Config::set('auth.providers.users.model', \App\Customer::class);
        }
        elseif($model  = "Workshop"){
            Config::set('auth.providers.users.model', \App\Workshop::class);
        }

        return $next($request);
        //return parent::handle($request, $next);
    }
}
