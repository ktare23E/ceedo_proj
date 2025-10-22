<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloatingCottageBooking extends Model
{
    protected $fillable = [
        'floating_cottage_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'total_hours',
        'total_amount',
        'status'
    ];

    public function floatingCottage(){
        return $this->belongsTo(FloatingCottage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment() { 
        return $this->morphOne(Payment::class, 'payable'); 
    }

}
