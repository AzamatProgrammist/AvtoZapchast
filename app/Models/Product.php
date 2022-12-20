<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'Org_Dub', ' part_number', 'image', 'model', 'brendi', 'markasi', 'product_id', 'ombor_id', 'shop_id', 'user_id'];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
