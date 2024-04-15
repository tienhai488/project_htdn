<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
