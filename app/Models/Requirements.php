<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    protected $fillable = [
        'requirement_name',
        'description',
        'file_type_allowed',
        'is_required'
    ];

    public function submissions(){
        return $this->hasMany(RequirementSubmission::class);
    }
}
