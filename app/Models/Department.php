<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Get the list of users belonging to the department
    public function users()
    {
        return $this->hasMany(UserProfile::class, 'department_id', 'id');
    }
}