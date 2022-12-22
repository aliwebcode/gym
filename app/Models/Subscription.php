<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(SubscriptionCategory::class, 'subscription_category_id', 'id');
    }

    public function allowed()
    {
        return $this->hasMany(AllowedClass::class, 'subscrib_id', 'id');
    }

    public function isAllowed()
    {
        if($this->allowed->count() > 0)
            return true;
        else
            return false;
    }
}
