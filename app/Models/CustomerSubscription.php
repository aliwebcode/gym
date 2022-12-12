<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class,'subscrib_id');
    }
}
