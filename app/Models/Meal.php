<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_plan_id', 
        'meal_time', 
        'recipe_name',      // Added recipe_name
        'photo', 
        'ingredients', 
        'nutritional_value', 
        'recipe_instructions',
        'calorie_count', 
        'date'
    ];

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }
}
