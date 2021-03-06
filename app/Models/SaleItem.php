<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'delivery_time',
        'quantity',
        'sale_id',
    ];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
