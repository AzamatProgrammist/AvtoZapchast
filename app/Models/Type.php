<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['chiqqan_yili', 'kelgan_yili', 'size', 'full_price', 'sotish_narxi', 'olingan_narxi', 'weight', 'yuk_narxi', 'soni', 'product_id', 'ombor_id', 'shop_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
