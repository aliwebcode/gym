<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

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

    public function gym_classes()
    {
        return $this->hasMany(GymClass::class);
    }
}
