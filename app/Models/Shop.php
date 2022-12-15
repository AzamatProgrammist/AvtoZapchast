<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['name_uz', 'slug', 'admin', 'user_id', 'meta_title', 'meta_description', 'meta_keywords'];


    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }

}
