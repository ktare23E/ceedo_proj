<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorApplication extends Model
{
    protected $fillable = [
        'user_id',
        'stall_id',
        'status',
        'remarks',
        'submitted_at',
        'approved_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stall(){
        return $this->belongsTo(Stall::class);
    }
}
