<?php

namespace App\Models;

use App\Enums\SalaryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'position_id',
        'approved_at',
        'approved_by',
        'status',
    ];

    protected $casts = [
        'status' => SalaryStatus::class,
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', SalaryStatus::APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('status', SalaryStatus::PENDING);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
