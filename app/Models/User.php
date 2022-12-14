<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statusWithLabel()
    {
        switch ($this->status) {
            case 0: $result = '<label class="badge bg-danger rounded-pill font-13">Inactive</label>'; break;
            case 1: $result = '<label class="badge bg-success rounded-pill font-13">Active</label>'; break;
        }
        return $result;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function classes()
    {
        return $this->hasMany(CustomerClass::class);
    }

    public function subscription()
    {
        return $this->hasOne(CustomerSubscription::class);
    }

    public function codes()
    {
        return $this->hasMany(VerificationCode::class);
    }

}
