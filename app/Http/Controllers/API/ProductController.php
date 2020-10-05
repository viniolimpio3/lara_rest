<?php

namespace App\Http\Controllers\API;

use App\API\ApiError;
use App\API\ApiMessage;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class ProductController extends Controller{

    private $p;
    private $msg;
    public function __construct(Product $product){
        //Com esse tipo de parâmetro, cria-se uma espécie de instância da classe Product (automação do Eloquent) 
        //logo, toda a vez que essa classe for chamada, $this->p recebe uma instância da classe/Entidade Product
        $this->p = $product;

        $this->msg = new ApiMessage();

        //$this->p->all(); -> retorna todos os registros no banco
    }

    public function index(){
        $data['data'] = $this->p->paginate(10);//método útil pacas - traz o próprio link da paginação!! tipo ?page=N
        return response()->json($data);        
    }

    public function get(Product $id){   
        $data['data'] = $id;
        return response()->json($data);
    }

    public function store(Request $req){
        try{
            $data = $req->all();
            $prod = $this->p->create($data);

            
            if(!$prod) return response()->json($this->msg->setMessage('err', 'Ocorreu um erro', 400));

            return response()->json($this->msg->setMessage('success', "Produto {$prod->name} criado com sucesso!", 200));

        }catch(Exception $e){
            if(config('app.debug'))//exceptions - debug laravel
                return response()->json($this->msg->setMessage('err' ,$e->getMessage(), 1010));
            
            return response()->json($this->msg->setMessage( 'err','Houve um erro na operação', 1010), 500);
        }
        // return redirect()->route('api.products_all')->header('method','GET');
    }

    public function update(Request $req, $id){
        try{
            $data = $req->all();

            $prod = $this->p->find($id);
            $prod->update($data);
            
            if(!$prod) return response()->json($this->msg->setMessage('err', 'Ocorreu um erro', 400));

            return response()->json($this->msg->setMessage('success',"Produto {$prod->name} alterado com sucesso", 201));

        }catch(Exception $e){

            if(config('app.debug'))//exceptions - debug laravel
                return response()->json($this->msg->setMessage( 'err',$e->getMessage(), 1010), 500);
            
            return response()->json($this->msg->setMessage( 'err','Houve um erro na operação', 1010), 500);
        }
    }
    public function delete($id){
        try{
            $p = $this->p->find($id);
            if (is_null($p)) return response()->json($this->msg->setMessage('err', "Produto ID $id não encontrado", 404), 404);
            
            $delete = $p->delete();

            if(!$delete) return response()->json($this->msg->setMessage('err', "Não foi possível deletar o produto $id", 400));

            return response()->json($this->msg->setMessage('success', "Produto {$p->name} removido com sucesso!", 200));

        }catch(Exception $e){
            if(config('app.debug')) return response()->json($this->msg->setMessage( 'err',$e->getMessage(), 1010), 500);

            return response()->json($this->msg->setMessage( 'err','Houve um erro na operação', 1010), 500);
        }

    }

}
