<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InkassaSub extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function inkassa()
    {
        return $this->belongsTo(Inkassa::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
