<?php

use App\Http\Controllers\V0\CartController;
use App\Http\Controllers\V0\ProductController;
use App\Http\Controllers\V0\RegisterController;
use App\Http\Controllers\V0\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v0', 'namespace' => 'V0'], function () {
    
    // Route::post('register', [RegisterController::class, 'register'])->name('register');
    // Route::post('login', [RegisterController::class, 'login'])->name('login');

    Route::group(['prefix' => 'produtos', 'namespace' => 'V0'], function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('{product}', [ProductController::class, 'show']);
    });

    Route::group(['prefix' => 'carrinho', 'as'=>'cart.', 'namespace' => 'V0'], function () {
        Route::get('', [CartController::class, 'index'])->name('index');
        Route::post('adicionar/{product}', [CartController::class, 'add'])->name('add');
        Route::delete('remover/{cartIndex}', [CartController::class, 'remove'])->name('remove');
    });

    Route::group(['prefix' => 'vendas', 'as'=>'sale.', 'namespace' => 'V0'], function () {
        Route::get('', [SaleController::class, 'index'])->name('index');
        Route::post('criar', [SaleController::class, 'store'])->name('store');
        Route::get('{sale}', [SaleController::class, 'show'])->name('show');
    });
});
