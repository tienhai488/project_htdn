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

    public function getImagesAttribute()
    {
        $collection = $this->getMedia(self::PRODUCT_IMAGES_COLLECTION);

        $imageUrls = [];

        foreach ($collection as $media) {
            $imageUrls[] = $media->getUrl();
        }

        return $imageUrls;
    }

    protected function getSalePriceAttribute()
    {
        return $this->product_prices()->latest()->first() ?
            $this->product_prices()->latest()->first()['sale_price']
            :
            0;
    }

    protected function getRegularPriceAttribute()
    {
        return $this->product_prices()->latest()->first() ?
            $this->product_prices()->latest()->first()['regular_price']
            :
            0;
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