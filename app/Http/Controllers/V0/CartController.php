<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart as CartResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends BaseController
{

    public function __construct()
    {
        cart()->setUser(1);
    }

    public function index()
    {
        $cart = cart()->items($displayCurrency = true);
        return $this->sendResponse(CartResource::collection($cart), 'Consulta realizada com sucesso.');
    }
   
    public function add(Product $product)
    {
        return $this->sendResponse(new CartResource(Product::addToCart($product->id)), 'Item(s) adicionado(s) com sucesso.');
    }

    public function remove($cartIndex)
    {
        return cart()->removeAt($cartIndex);
    }

}
