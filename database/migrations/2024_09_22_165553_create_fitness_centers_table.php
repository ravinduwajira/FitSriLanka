<?php

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
        Schema::create('fitness_centers', function (Blueprint $table) {
            $table->id('fitnesscenterid'); // Primary key
        $table->foreignId('professional_id')->constrained('users')->onDelete('cascade'); // Foreign key from users table
        $table->string('name'); // Fitness center name
        $table->string('address'); // Fitness center address
        $table->decimal('monthly_fee', 8, 2); // Monthly fee
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_centers');
    }
};
