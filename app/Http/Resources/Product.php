<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'delivery_time' => $this->delivery_time,
            'image_url' => $this->image_url,
            'slug' => $this->slug,
            'created_at' => $this->created_at->setTimezone("America/Sao_Paulo")->format('d/m/Y H:i:s'),
            'updated_at' => $this->updated_at->setTimezone("America/Sao_Paulo")->format('d/m/Y H:i:s'),
        ];
    }
}
