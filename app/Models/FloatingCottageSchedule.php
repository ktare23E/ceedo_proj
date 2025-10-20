<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloatingCottageSchedule extends Model
{
    protected $fillable = [
        'floting_cottage_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'remarks'
    ];

    public function floatingCottage(){
        return $this->belongsTo(FloatingCottage::class);
    }
}
