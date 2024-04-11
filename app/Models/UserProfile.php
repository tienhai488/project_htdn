<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserProfile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const USER_PROFILE_THUMBNAIL_COLLECTION = 'user_profile_thumbnail';

    protected $fillable = [
        'user_id',
        'position_id',
        'department_id',
        'phone_number',
        'gender',
        'citizen_id',
        'birthday',
        'address',
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    protected function getThumbnailAttribute(): string
    {
        return $this->getFirstMediaUrl(self::USER_PROFILE_THUMBNAIL_COLLECTION) ?: asset('src/assets/img/user-default.jpg');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(config('media-library.media_model'), 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::USER_PROFILE_THUMBNAIL_COLLECTION)->singleFile();
    }
}