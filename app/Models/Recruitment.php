<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department_id',
        'position_id',
        'quantity',
        'expired_time',
        'minimum_salary',
        'maximum_salary',
        'description',
    ];

    protected $casts = [
        'expited_time' => 'datetime',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}