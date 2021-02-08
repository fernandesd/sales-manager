<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_cost',
    ];

    public function getMaxDeliveryTimeAttribute(){
        return $this->items()->max('delivery_time');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public static function rules(){ 
        return [
            'items'=>'required|array'
        ];  
    }

    public static function messages(){ 
        return [
            'items.required'=>'campo obrigatório',
            'items.array'=>'O campo :attribute deve ser um array',
        ];  
    }

    public static function attributes(){ 
        return [
            'items'=>'itens',
        ];  
    }
}
