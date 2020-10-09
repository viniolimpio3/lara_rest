<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class Authenticate extends BaseMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */    
    protected function redirectTo($request){
        if (! $request->expectsJson()) {
            return route('NAME_ROTA_LOGIN');
        }
    }

    // /**
    // * Handle an incoming request.
    // * @param  \Illuminate\Http\Request  $req
    // * @param  \Closure  $next
    // * @return mixed
    // */

    // public function handle(Request $req, Closure $next){
    //     try{
    //         $user = JWTAuth::parseToken()->authenticate();
    //     }catch(Exception $e){
    //         if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) return response()->json(['status' => 'Token is Invalid']);
    //         else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) return response()->json(['status' => 'Token is Expired']);
    //         else return response()->json(['status' => 'Authorization Token not found']);
    //     }
        
    //     return $next($req);           
    // }
}
