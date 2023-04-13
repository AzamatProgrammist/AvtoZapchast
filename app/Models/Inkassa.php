<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inkassa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inkassaSubs(){
        return $this->hasMany(InkassaSub::class, 'main_id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
     
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
