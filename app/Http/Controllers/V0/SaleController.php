<?php

namespace App\Http\Controllers\V0;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Sale as SaleResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\V0\Sale\StoreRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleController extends BaseController
{
    public function index(){
        $sales = Sale::all();
        return $this->sendResponse(SaleResource::collection($sales), 'Consulta realizada com sucesso.');

    }
    public function show($idSale){
        $sale = Sale::find($idSale);

        if (is_null($sale)) 
            return $this->sendError('Venda não localizada.');

        return $this->sendResponse(new SaleResource($sale), 'Consulta realizada com sucesso.');
    }
    
    public function store(StoreRequest $request){
        cart()->setUser(1);

        $cart_items = cart()->items();
        
        $sale = Sale::create(['total_cost' => cart()->payable()]);
        $product_ids = collect($cart_items)->pluck('modelId');
        $items = Product::find($product_ids);
        foreach($cart_items as $item){
            $items->firstWhere('id', $item['modelId'])->quantity = $item['quantity'];
        }

        $sale->items()->createMany($items->toArray());

        cart()->clear();
        return $this->sendResponse(new SaleResource($sale), 'Venda realizada com sucesso.');
    }
}
