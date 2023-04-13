<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'Org_Dub',
        'part_number',
        'image',
        'model',
        'brendi',
        'markasi',
        'analog',
        'chiqqan_yili',
        'kelgan_yili',
        'size',
        'full_price',
        'sotish_narxi',
        'olingan_narxi',
        'weight',
        'yuk_narxi',
        'soni',
        'little',
        'many',
        'ombor_id',
        'shop_id',
        'user_id',
    ];

    
    public function inkassaSubs(){
        return $this->hasMany(InkassaSub::class, 'product_id');
    }
}
