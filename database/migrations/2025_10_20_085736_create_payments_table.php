<?php

use App\Models\User;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->morphs('payable'); // for stall rent or cottage booking
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['gcash', 'cash', 'bank'])->default('gcash');
            $table->string('reference_number')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->enum('status', ['pending', 'verified', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
