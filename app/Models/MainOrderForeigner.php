<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainOrderForeigner extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Orders_to_foreigners(){
        return $this->hasMany(Orders_to_foreigner::class, 'main_id');
    }

    
}
