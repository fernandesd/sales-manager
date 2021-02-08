<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sale extends JsonResource
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
            'total_cost' => $this->total_cost,
            'max_delivery_time' => $this->max_delivery_time,
            'items' => $this->items,
            'created_at' => $this->created_at->setTimezone("America/Sao_Paulo")->format('d/m/Y H:i:s'),
            'updated_at' => $this->updated_at->setTimezone("America/Sao_Paulo")->format('d/m/Y H:i:s'),
        ];
    }
}
