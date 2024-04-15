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

    public function user_profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'user_id', 'id');
    }

    public function getThumbnailAttribute()
    {
        return $this->user_profile ?
            $this->user_profile->thumbnail
            :
            asset('src/assets/img/user-default.jpg');
    }

    public function getApprovedSalaryAttriute()
    {
        return $this
            ->salaries()
            ->where('status', SalaryStatus::APPROVED)
            ->orderByDesc('approved_at')
            ->first();
    }

    public function getAllApprovedSalaryAttribute()
    {
        return $this
            ->salaries()
            ->where('status', SalaryStatus::APPROVED)
            ->with(['user', 'approvedBy', 'position'])
            ->orderByDesc('approved_at')
            ->get();
    }

    public function getPendingSalaryAttribute()
    {
        return $this
            ->salaries()
            ->where('status', SalaryStatus::PENDING)
            ->orderByDesc('created_at')
            ->first();
    }
}