<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'approved_by',
        'approved_at',
        'customer_id',
        'payment_status',
        'delivery_status',
        'shipping_unit_id',
        'note',
    ];

    protected $casts = [
        'payment_status' => PaymentStatus::class,
        'delivery_status' => DeliveryStatus::class,
    ];

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shippingUnit(): BelongsTo
    {
        return $this->belongsTo(ShippingUnit::class, 'shipping_unit_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'order_details',
            'order_id',
            'product_id'
        )->withPivot('quantity');
    }

    public function productPrices(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductPrice::class,
            'order_details',
            'order_id',
            'product_price_id'
        )->withPivot('quantity');
    }
}
