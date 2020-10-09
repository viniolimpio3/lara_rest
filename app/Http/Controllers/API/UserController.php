<?php

namespace App\Http\Controllers\API;

use App\API\ApiMessage;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    private $users;
    private $m;
    public function __construct(){
        $this->users = new User();
        $this->m = new ApiMessage();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req){
        return $this->users->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req){
        try{

            $data = $req->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);
            
            $data['password'] = cryptPass($data['password']);

            if(!$data) return response()->json($this->m->setMessage('error', 'bad_credentials', 400), 400);
            
            $this->users->create($data);

            return response()->json($this->m->setMessage('successs', "Usuário {$data['name']} criado com sucesso!", 201), 201);

        }catch(Exception $e){
            return response()->json($this->m->setMessage('error', $e->getMessage(), 400), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            if(!isset($id)) throw new Exception('User ID não informado');    
            return response()->json($this->users->find($id));

        }catch(Exception $e){
            return response()->json($this->m->setMessage('error', $e->getMessage(), 400), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
