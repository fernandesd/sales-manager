<?php

use App\Http\Controllers\V0\CartController;
use App\Http\Controllers\V0\ProductController;
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
    Route::group(['prefix' => 'produtos', 'namespace' => 'V0'], function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('{product}', [ProductController::class, 'show']);
    });

    Route::group(['prefix' => 'carrinho', 'as'=>'cart.', 'namespace' => 'V0'], function () {
        Route::get('', [CartController::class, 'index'])->name('index');
        Route::get('adicionar/{product}', [CartController::class, 'add'])->name('add');
        Route::get('remover/{product}', [CartController::class, 'remove'])->name('remove');
    });
});
