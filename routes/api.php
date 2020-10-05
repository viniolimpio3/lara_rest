<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Facade\Ignition\SolutionProviders\InvalidRouteActionSolutionProvider;



$namespace_controller = 'App\Http\Controllers\API';

//NAMESPACE API - CONTROLLERS DA API\\
Route::namespace($namespace_controller)->name('api.')->group(function(){
    //Routes AUTH ------------------------------------------------
    Route::middleware('auth:api')->prefix('/auth')->group(function(){
        Route::post('/login', [AuthController::class, 'login'])->name('login_auth');//return token      
    }); 

    //produtos ---------------------------------------------------------
    Route::prefix('/products')->group(function(){//RECURSO
        //ENDPOINTS
        Route::get('/', [ProductController::class , 'index'] )->name('all_products');
        Route::get('/{id}',  [ProductController::class , 'get'] )->name('id_product');
 
        Route::post('/', [ProductController::class , 'store'])->name('store_product');

        Route::put('/{id}',  [ProductController::class , 'update'])->name('update_product');

        Route::delete('/{id}',  [ProductController::class , 'delete'])->name('delete_product');
    });

    //Usuários ------------------------------
    Route::prefix('/users')->group(function(){
        Route::get('/',  [UserController::class , 'index'])->name('all_users');
        Route::post('/',  [UserController::class , 'store'])->name('store_user');
    });
});