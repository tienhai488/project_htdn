<?php

namespace App\Models;

use App\Enums\WorkingStatus;
use App\Enums\WorkType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimekeepingDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'timekeeping_id',
        'working_status',
        'work_type',
        'date',
        'ot',
    ];

    protected $casts = [
        'working_status' => WorkingStatus::class,
        'work_type' => WorkType::class,
    ];

    public function timekeeping(): BelongsTo
    {
        return $this->belongsTo(Timekeeping::class, 'timekeeping_id', 'id');
    }
}
