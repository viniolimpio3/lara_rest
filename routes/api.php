<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

$namespace_controller = 'App\Http\Controllers\API';

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace($namespace_controller)->name('api.')->group(function(){
    Route::prefix('/products')->group(function(){//RECURSO
        //ENDPOINTS
        Route::get('/','ProductController@index')->name('products_all');
        Route::get('/{id}', 'ProductController@get')->name('products_id');
 
        Route::post('/','ProductController@insert')->name('insert_product');

        Route::put('/{id}', 'ProductController@update')->name('update_product');

        Route::delete('/{id}', 'ProductController@delete')->name('delete_product');
    });
    Route::prefix('/users')->group(function(){
        // Route::get();
    });
});