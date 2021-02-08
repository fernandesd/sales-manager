<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart as CartResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends BaseController
{

    public function __construct()
    {
        cart()->setUser(User::find(1)->id);
    }

    public function index()
    {
        $cart = cart()->items($displayCurrency = true);
        return $this->sendResponse(CartResource::collection($cart), 'Consulta realizada com sucesso.');
    }
   
    public function add(Product $product)
    {
        return $this->sendResponse(new CartResource(Product::addToCart($product->id)), 'Item adicionado com sucesso.');
    }

    public function remove($cartIndex)
    {
        return $this->sendResponse(new CartResource(cart()->removeAt($cartIndex)), 'Item removido do carrinho.');

    }

}
