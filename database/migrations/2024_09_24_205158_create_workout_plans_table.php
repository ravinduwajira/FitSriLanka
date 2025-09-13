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
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('client_id'); // Enrolled client
            $table->text('workout_schedule');
            $table->text('workout_benefits');
            $table->text('workout_duration');
            $table->text('additional_info')->nullable();
            $table->string('workout_image')->nullable(); // To store image path
            $table->string('workout_video')->nullable(); // To store video path
            $table->timestamps();
        
            $table->foreign('professional_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
