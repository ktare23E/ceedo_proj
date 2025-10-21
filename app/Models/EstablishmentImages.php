<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstablishmentImages extends Model
{
    protected $fillable = [
        'establishment_id',
        'file_path'
    ];

    public function establishment(){
        return $this->belongsTo(Establishment::class);
    }
}
