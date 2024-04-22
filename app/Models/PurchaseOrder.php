<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'approved_at',
        'approved_by',
        'supplier_id',
        'note',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'purchase_order_details',
            'purchase_order_id',
            'product_id',
        )->withPivot('quantity');
    }

    public function productPrices()
    {
        return $this->belongsToMany(
            ProductPrice::class,
            'purchase_order_details',
            'purchase_order_id',
            'product_price_id',
        )->withPivot('quantity');
    }
}
