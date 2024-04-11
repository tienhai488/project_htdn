<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Get the list of users belonging to the position
    public function users()
    {
        return $this->hasMany(UserProfile::class, 'position_id', 'id');
    }
}