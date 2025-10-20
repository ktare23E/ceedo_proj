<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentReminders extends Model
{
    protected $fillable = [
        'user_id',
        'stall_id',
        'due_date',
        'is_sent'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stall(){
        return $this->belongsTo(Stall::class);
    }
}
