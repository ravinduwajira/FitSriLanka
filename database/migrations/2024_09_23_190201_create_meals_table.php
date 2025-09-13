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


// Create meals table
Schema::create('meals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('meal_plan_id')->constrained('meal_plans')->onDelete('cascade'); // Link to meal_plan
    $table->string('meal_time'); // breakfast, lunch, dinner
    $table->string('photo')->nullable(); // Path to meal photo
    $table->string('ingredients'); // List of ingredients
    $table->text('nutritional_value'); // Nutritional information
    $table->text('recipe_instructions'); // Recipe instructions
    table->int('calorie_count');
    $table->date('date'); // The date of this meal (should match within the plan's 7 days)
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
