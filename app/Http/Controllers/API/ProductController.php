<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller{

    private $p;
    public function __construct(Product $product){
        //Com esse tipo de parâmetro, cria-se uma espécie de instância da classe Product (automação do Eloquent) 
        //logo, toda a vez que essa classe for chamada, $this->p recebe uma instância da classe/Entidade Product
        $this->p = $product;

        //$this->p->all(); -> retorna todos os registros no banco
    }

    public function index(){
        $data['data'] = $this->p->paginate(5);//método útil pacas - traz o próprio link da paginação!! tipo ?page=N
        return response()->json($data);        
    }

    public function get(Product $id){   
        $data['data'] = $id;
        return response()->json($data);
    }

    public function insert(Request $req){
        $data = $req->all();
        $create = $this->p->create($data);
        if(!$create) return response()->json(['status' => false])->status(400);

        return redirect()->route('api.products_all')->header('method','GET');
    }


}
