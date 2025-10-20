<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloatingCottage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_hour',
        'capacity',
        'image',
        'status'
    ];

    public function schedules(){
        return $this->hasMany(FloatingCottageSchedule::class);
    }
}
