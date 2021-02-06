<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $products->each(function($product){
            return $product->setImageUrl();
        });

        return response()
                ->json(['status' => 200, 'message'=>'Consulta realizada com sucesso!', 'data'=>$products]);
    }

    public function show(Product $product){
        $product->setImageUrl();
        return response()
                ->json(['status' => 200, 'message'=>'Consulta realizada com sucesso!', 'data'=>$product]);
    }
}
