<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Web\WB_ProductController;
use App\Http\Controllers\Web\WB_UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function(){
    return view('welcome');
});

Route::prefix('/user')->name('web.user.')->group(function(){

   Route::get('/signin', [WB_UserController::class, 'login'])->name('signin');

   Route::get('/signup', [WB_UserController::class, 'create'])->name('signup');

});

Route::prefix('/products')->name('web.product.')->group(function(){
    Route::get('/', [WB_ProductController::class, 'index'])->name('list');
});
