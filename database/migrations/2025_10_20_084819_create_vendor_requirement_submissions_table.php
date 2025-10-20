<?php

use App\Models\Requirement;
use App\Models\VendorApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_requirement_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VendorApplication::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Requirement::class)->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->enum('status', ['submitted', 'verified', 'rejected'])->default('submitted');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_requirement_submissions');
    }
};
