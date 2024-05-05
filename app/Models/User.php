<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\SalaryStatus;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles;

    const USER_THUMBNAIL_COLLECTION = 'user_thumbnail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => UserStatus::class,
    ];

    protected $appends = [
        'thumbnail',
    ];

    protected $with = [
        'media',
        'salaries',
    ];

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class, 'user_id', 'id');
    }

    public function timekeepings(): HasMany
    {
        return $this->hasMany(Timekeeping::class, 'user_id', 'id');
    }

    protected function approvedSalary(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->salaries
                ->where('status', SalaryStatus::APPROVED)
                ->sortByDesc('approved_at')
                ->first(),
        );
    }

    protected function pendingSalary(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->salaries
                ->where('status', SalaryStatus::PENDING)
                ->sortByDesc('created_at')
                ->first(),
        );
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl(self::USER_THUMBNAIL_COLLECTION)
                ?:
                asset('src/assets/img/user-default.jpg'),
        );
    }

    public function media(): MorphMany
    {
        return $this->morphMany(config('media-library.media_model'), 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::USER_THUMBNAIL_COLLECTION)->singleFile();
    }
}
