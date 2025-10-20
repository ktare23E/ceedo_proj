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
}
