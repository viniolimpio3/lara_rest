<?php

namespace App\Http\Middleware;

use App\API\ApiMessage;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware{//NÃO ESQUECER DE COLOCAR ALIAS DO MIDDLEWARE EM KERNEL
    private $m;
    public function __construct(){
        $this->m = new ApiMessage();
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */    
    protected function redirectTo($request){
        if (! $request->expectsJson()) {
            return route('api.login_auth');
        }
    }

    /**
    * Handle an incoming request.
    * @param  \Illuminate\Http\Request  $req
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $req, Closure $next){
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) return response()->json($this->m->setMessage('error', 'invalid_token', 401), 401);
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) return response()->json($this->m->setMessage('error', 'expired_token', 401), 401);
            else return response()->json($this->m->setMessage('error', 'invalid_token', 401), 401);
        }
        try{
            // $routeName = $req->route();

            // return redirect(route($routeName->action['as']));
            // redirect()->route($routeName->action['as']);
            // $req->user = $user;
            return $next($req);
        }catch(Exception $e){
            return response()->json([$e->getMessage()]);
        }
    }
}
