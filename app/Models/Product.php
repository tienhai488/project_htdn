<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

    protected $with = [
        'product_prices',
        'category',
        'media',
    ];

    protected $appends = [
        'thumbnail',
        'images',
        'sale_price',
        'regular_price',
    ];

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl(self::PRODUCT_THUMBNAIL_COLLECTION)
                ?:
                asset('src/assets/img/no_product_image.png'),
        );
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: function () {
                $collection = $this->getMedia(self::PRODUCT_IMAGES_COLLECTION);

                $imageUrls = [];

                foreach ($collection as $media) {
                    $imageUrls[] = $media->getUrl();
                }

                return $imageUrls;
            }
        );
    }

    protected function salePrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->product_prices()->latest()->first() ?
                $this->product_prices()->latest()->first()['sale_price']
                :
                0,
        );
    }

    protected function regularPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->product_prices()->latest()->first() ?
                $this->product_prices()->latest()->first()['regular_price']
                :
                0,
        );
    }

    public function product_prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(config('media-library.media_model'), 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();

        $this->addMediaCollection('images');
    }
}
