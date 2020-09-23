<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$namespace_controller = 'App\Http\Controllers\API';

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace($namespace_controller)->name('api.')->group(function(){
    Route::prefix('/products')->group(function(){
        
        Route::get('/','ProductController@index')->name('products_all');

        Route::post('/','ProductController@insert')->name('insert_product');

        Route::get('/{id}', 'ProductController@get')->name('products_id');

    });
});