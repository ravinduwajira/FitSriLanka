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
        Schema::create('userinfo', function (Blueprint $table) {
            $table->id(); // This will be the primary key and will reference the 'users' table 'id'
            $table->date('birthday');
            $table->integer('age');
            $table->integer('height_cm');
            $table->decimal('weight_kg', 5, 2);
            $table->enum('activity_level', ['Sedentary', 'Active', 'Very Active']);
            $table->string('fitness_goal', 80);
            $table->enum('dietary_preference', ['None', 'Vegetarian', 'Vegan', 'Keto']);
            $table->text('medical_conditions')->nullable();
            $table->timestamps();
        
            // Foreign key constraint on the 'id' field to the 'users' table 'id'
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
