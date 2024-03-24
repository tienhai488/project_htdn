<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }
}