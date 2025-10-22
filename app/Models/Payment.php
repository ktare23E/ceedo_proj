<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'payable',
        'amount',
        'method',
        'reference_number',
        'proof_of_payment',
        'status',
        
    ];

    public function user() { 
        return $this->belongsTo(User::class); 
    }

    public function payable() { 
        return $this->morphTo(); 
    } // for Stall or CottageBooking


}
