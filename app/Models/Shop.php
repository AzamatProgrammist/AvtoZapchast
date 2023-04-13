<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['name_uz', 'slug', 'admin', 'status', 'usertype', 'user_id', 'meta_title', 'meta_description', 'meta_keywords'];


    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function inkassas(){
        return $this->hasMany(Inkassa::class);
    }
}

