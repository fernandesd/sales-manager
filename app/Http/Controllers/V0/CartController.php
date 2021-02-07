<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        cart()->setUser(1);
        return cart()->items($displayCurrency = true);
    }
   
    public function add(Product $product)
    {
        cart()->setUser(1);
        return Product::addToCart($product->id);
    }

    public function remove(Request $request, Product $product)
    {
        cart()->setUser(1);
        return cart()->removeAt(0);
    }

}
