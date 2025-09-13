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
        Schema::create('fastingtrackers', function (Blueprint $table) {
            $table->id(); // Primary key, fast_id
            $table->unsignedBigInteger('user_id'); // Authenticated user ID
            $table->string('fasting_plan'); // Type of fasting (e.g., 16/8, 12/12)
            $table->timestamp('start_time')->nullable(); // Start time of fasting
            $table->timestamp('end_time')->nullable(); // End time of fasting
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fastingtrackers');
    }
};
