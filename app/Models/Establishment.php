<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address'
    ];

    public function stalls(){
        return $this->hasMany(Stall::class);
    }
}
