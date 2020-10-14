<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Http\JsonResponse;
use App\API\ApiMessage;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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
        // $this->middleware('jwt_middleware',['except' => 'login']);//usa o middleware em todos métodos, menos no login - [OBSOLETO] -> USAR MIDDLEWARE NAS ROTAS
        $this->m = new ApiMessage();
    }
 
    /**
     * Get a JWT via given credentials.
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

    public function me(Request $req){
        return response()->json(['user' => getAuthorizedUser()]);
    }

    public function logout(Request $req){
        try{
            Auth::logout();
            return response()->json($this->m->setMessage('success', 'logout_success', 200), 200);
        }catch(Exception $e){
            return response()->json($this->m->setMessage('error', $e->getMessage(), 400), 400);
        }
    }

    public function returnToken($token){
        return response()->json([
            'access_token'=> $token,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::now()->addHours(2)->timestamp
        ]);
    }
}
