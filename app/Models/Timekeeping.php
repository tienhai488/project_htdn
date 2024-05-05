<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timekeeping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved_by',
        'month',
        'year',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function timekeepingDetails(): HasMany
    {
        return $this->hasMany(TimekeepingDetail::class, 'timekeeping_id', 'id');
    }
}
