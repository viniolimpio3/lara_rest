<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\JsonResponse;
use App\API\ApiMessage;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            'email' => 'required|unique|email', 
            'password'=> 'required'
        ]);        

        $credentials['password'] = cryptPass($credentials['password']);

        if(!$credentials) return response()->json($this->m->setMessage('error','invalid_credentials', 400), 401);

        $token = JWTAuth::attempt($credentials);
        if(!$token) return response()->json($this->m->setMessage('error','unauthorized', 401), 401);

        return $this->returnToken($token);
        
    }

    public function returnToken($token){
        return response()->json([
            'access_token'=> $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->setTTlL($token)
        ]);
    }
}
