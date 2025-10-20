<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorRequirementSubmission extends Model
{
    protected $fillable = [
        'vendor_application_id',
        'requirement_id',
        'file_path',
        'status',
        'remarks'
    ];

    public function requirement(){
        return $this->belongsTo(Requirement::class);
    }

    public function vendorApplication(){
        return $this->belongsTo(VendorApplication::class);
    }
}
