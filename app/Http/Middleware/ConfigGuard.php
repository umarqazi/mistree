<?php

namespace App\Http\Middleware;

use Config;
use Closure;

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
        if($model  == "Workshop"){
            Config::set('auth.providers.users.model', \App\Workshop::class);
        }
        elseif($model  == "Customer"){
            Config::set('auth.providers.users.model', \App\Customer::class);
        }
        elseif($model   == "admin"){
            Config::set('auth.providers.users.model', \App\Admin::class);
        }

        return $next($request);
    }
}
