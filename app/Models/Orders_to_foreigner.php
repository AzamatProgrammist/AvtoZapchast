<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_to_foreigner extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function main_order_foreigner()
    {
        return $this->belongsTo(MainOrderForeigner::class);
    }
}
