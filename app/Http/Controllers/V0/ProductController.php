<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Consulta realizada com sucesso.');
    }

    public function show($slugProduct)
    {
        $product = Product::whereSlug($slugProduct)->first();

        if (is_null($product)) 
            return $this->sendError('Produto não encontrado.');

        return $this->sendResponse(new ProductResource($product), 'Consulta realizada com sucesso.');
    }
}
