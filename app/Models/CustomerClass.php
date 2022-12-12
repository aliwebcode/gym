<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gym_class()
    {
        return $this->belongsTo(GymClass::class,'class_id');
    }
}
