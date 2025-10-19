<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'requirement_id',
        'file_path',
        'status',
        'remarks'
    ];

    public function requirement(){
        return $this->belongsTo(Requirements::class);
    }
}
