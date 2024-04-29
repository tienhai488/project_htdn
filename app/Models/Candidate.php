<?php

namespace App\Models;

use App\Enums\CandidateStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const CANDIDATE_CV_COLLECTION = 'candidate_cv';

    protected $fillable = [
        'recruitment_id',
        'name',
        'email',
        'phone_number',
        'gender',
        'birthday',
        'desired_salary',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => CandidateStatus::class,
    ];

    protected $appends = [
        'cv',
    ];

    protected $with = [
        'media',
    ];

    public function recruitment(): BelongsTo
    {
        return $this->belongsTo(Recruitment::class, 'recruitment_id', 'id');
    }

    protected function cv(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl(self::CANDIDATE_CV_COLLECTION),
        );
    }

    public function media(): MorphMany
    {
        return $this->morphMany(config('media-library.media_model'), 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::CANDIDATE_CV_COLLECTION)->singleFile();
    }
}