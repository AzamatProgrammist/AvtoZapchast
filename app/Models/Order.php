<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function main_order()
    {
        return $this->belongsTo(MainOrder::class);
    }
}
