<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StallImages extends Model
{
    protected $fillable = [
        'stall_id',
        'file_path'
    ];

    public function stall(){
        return $this->belongsTo(Stall::class);
    }
}
