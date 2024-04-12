<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\SalaryStatus;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'approved_salary',
    ];

    public function user_profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'user_id', 'id');
    }

    public function getApprovedSalaryAttribute()
    {
        return $this
            ->salaries()
            ->approved()
            ->orderByDesc('approved_at')
            ->first();
    }

    public function getAllApprovedSalaryAttribute()
    {
        return $this
            ->salaries()
            ->approved()
            ->with(['user', 'approvedBy', 'position'])
            ->orderByDesc('approved_at')
            ->get();
    }

    public function getPendingSalaryAttribute()
    {
        return $this
            ->salaries()
            ->pending()
            ->orderByDesc('created_at')
            ->first();
    }
}
