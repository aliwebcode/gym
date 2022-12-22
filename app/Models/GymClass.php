<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;

    protected $table = 'gym_classes';

    protected $guarded = [];

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function statusWithLabel()
    {
        switch ($this->status) {
            case 0: $result = '<label class="badge bg-danger rounded-pill font-13">Inactive</label>'; break;
            case 1: $result = '<label class="badge bg-success rounded-pill font-13">Active</label>'; break;
        }
        return $result;
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function training()
    {
        return $this->belongsTo(Training::class)->active();
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function allowed()
    {
        return $this->hasMany(AllowedClass::class, 'class_id');
    }

    public function isAllowed()
    {
        if($this->allowed->count() > 0)
            return true;
        else
            return false;
    }

}
