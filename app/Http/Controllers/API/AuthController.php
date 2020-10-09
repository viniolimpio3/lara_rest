<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Http\JsonResponse;
use App\API\ApiMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;
use Tymon\JWTAuth\Facades\JWTAuth as AuthJWT;


class AuthController extends Controller
{
    private $m;
    /**
     * Criando instância do controller
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:api',['except' => 'login']);
        $this->m = new ApiMessage();
    
    }
 
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $req){
        $credentials = $req->validate([
            'email' => 'required|email', 
            'password'=> 'required'
        ]);
                
        if(!$credentials) return response()->json($this->m->setMessage('error','credentials_not_exists', 400), 401);
        
        $token = AuthJWT::attempt($credentials);
        
        if(!$token) return response()->json($this->m->setMessage('error','unauthorized', 401), 401);

        return $this->returnToken($token);
    }


    public function logout(Request $req){
        AuthJWT::logout();
        return response()->json($this->m->setMessage('success', 'logout_success', 200), 200);
    }

    public function returnToken($token){
        return response()->json([
            'access_token'=> $token,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::now()->addHours(2)->timestamp
        ]);
    }
}
