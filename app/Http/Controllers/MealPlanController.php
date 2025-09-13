<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealPlan;
use App\Models\Meal;
use Carbon\Carbon;


class MealPlanController extends Controller
{
    public function store(Request $request)
    {
        // Update validation to include recipe_name and calorie_count
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'meals.*.*.recipe_name' => 'required|string',  // Validate recipe name
            'meals.*.*.ingredients' => 'required|string',
            'meals.*.*.nutritional_value' => 'required|string',
            'meals.*.*.recipe_instructions' => 'required|string',
            'meals.*.*.calorie_count' => 'required|numeric|min:0', // Validate calorie count
        ]);
    
        $professional_id = auth()->id();
        $user_id = $request->user_id;
    
        // Create meal plan for the next 7 days
        $mealPlan = MealPlan::create([
            'user_id' => $user_id,
            'professional_id' => $professional_id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(6), // 7-day plan
        ]);
    
        // Save each meal in the meal plan
        foreach ($request->meals as $day => $mealData) {
            foreach ($mealData as $meal_time => $meal) {
                $photoPath = null;
                if (isset($meal['photo']) && $meal['photo']->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $meal['photo']->getClientOriginalExtension();
    
                    // Move the file to the specified directory with the generated filename
                    $photoPath = $meal['photo']->move('uploads/meal_photos', $filename);
                }
    
                // Create meal including recipe_name and calorie_count
                Meal::create([
                    'meal_plan_id' => $mealPlan->id,
                    'meal_time' => ucfirst($meal_time),
                    'recipe_name' => $meal['recipe_name'], // Save recipe name
                    'photo' => $photoPath,
                    'ingredients' => $meal['ingredients'],
                    'nutritional_value' => $meal['nutritional_value'],
                    'recipe_instructions' => $meal['recipe_instructions'],
                    'calorie_count' => $meal['calorie_count'], // Save calorie count
                    'date' => Carbon::now()->addDays($day - 1),
                ]);
            }
        }
    
        return redirect()->route('Professional.managedietplans')->with('success', 'Meal Plan created successfully!');
    }
    


    
}
