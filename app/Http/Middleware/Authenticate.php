<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class Authenticate extends BaseMiddleware // SE QUISER USAR - MIDDLEWARE 'auth'
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */    
    protected function redirectTo($request){
        return response()->json($request);

        if (! $request->expectsJson()) {
            return route('NAME_ROTA_LOGIN');
        }
    }


}
