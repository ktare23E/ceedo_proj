<?php

use App\Models\FloatingCottage;
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
        Schema::create('floating_cottage_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FloatingCottage::class)->constrained()->onDelete('cascade');
            $table->date('date'); // Specific date
            $table->time('start_time'); // When available starts
            $table->time('end_time');   // When available ends
            $table->enum('status', ['available', 'unavailable', 'maintenance'])->default('available');
            $table->text('remarks')->nullable(); // Notes (e.g. maintenance reason)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floating_cottage_schedules');
    }
};
