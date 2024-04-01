<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $table = 'product_prices';

    protected $fillable = [
        'product_id',
        'sale_price',
        'regular_price',
    ];
}