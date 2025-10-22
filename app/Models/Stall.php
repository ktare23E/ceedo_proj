<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    protected $fillable = [
        'establishment_id',
        'stall_number',
        'price',
        'status',
        'size',
        'description'
    ];

    public function establisment(){
        return $this->belongsTo(Establishment::class);
    }

    public function images(){
        return $this->hasMany(StallImages::class);
    }

    public function rentReminders(){
        return $this->hasMany(RentReminders::class);
    }

    public function firstImage(){
        return $this->hasOne(StallImages::class)->orderBy('id');
    }
}
