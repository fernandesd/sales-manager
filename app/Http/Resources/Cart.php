<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($this->resource['modelId'])) {
            $product = Product::find($this->resource['modelId']);
            return [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'delivery_time' => $product->delivery_time,
                'quantity' => $this->resource['quantity'],
            ];
        }

        return parent::toArray($request);
        
    }
}
