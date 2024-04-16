<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'count_users_pending_salary',
    ];

    // Get the list of salaries belonging to the position
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'position_id', 'id');
    }

    /**
     * Count the number of users in the position waiting for approval
     */
    protected function countUsersPendingSalary(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->salaries()
                ->pending()
                ->distinct('user_id')
                ->count(),
        );
    }
}
