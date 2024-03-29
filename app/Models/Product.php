<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PRODUCT_THUMBNAIL_COLLECTION = 'product_thumbnail';

    const PRODUCT_IMAGES_COLLECTION = 'product_images';

    protected $fillable = [
        'name',
        'quantity',
        'category_id',
        'description',
    ];

    // protected $appends = ['thumbnail'];

    protected function getThumbnailAttribute(): string
    {
        return $this->getFirstMediaUrl(self::PRODUCT_THUMBNAIL_COLLECTION) ?: asset('src/assets/img/no_product_image.png');
    }

    public function product_prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();

        $this->addMediaCollection('images');
    }
}