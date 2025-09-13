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
        Schema::create('fitness_center_enrollments', function (Blueprint $table) {
            $table->id('fc_enrollment_id'); // Custom primary key
            $table->unsignedBigInteger('fitness_center_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name')->nullable(); // Optional, based on your use case
            $table->string('enrollment_status'); // e.g., 'enrolled' or 'unenrolled'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_center_enrollments');
    }
};
