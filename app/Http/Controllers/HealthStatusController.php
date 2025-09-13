<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfo;
use App\Models\HealthStatus;


class HealthStatusController extends Controller
{
    public function index()
    {
       
        $latestStatus = HealthStatus::where('user_id', auth()->id())
            ->latest()
            ->first();
            
            $heightinfo = UserInfo::where('id', auth()->id())
            ->first();
            $height = $heightinfo->height_cm;

        return view('health-status', compact('latestStatus','height'));
    }

    public function store(Request $request)
{
    $userId = auth()->id();

    // Check if a start weight already exists for this user
    $existingStartWeight = HealthStatus::where('user_id', $userId)
        ->whereNotNull('start_weight')
        ->value('start_weight'); // Get the existing start weight, if any

    // If no start weight exists, take the start weight from the request
    $startWeight = $existingStartWeight ?: $request->start_weight;

    // Calculate BMI
    $heightInMeters = $request->height / 100; // Convert height from cm to meters
    $bmi = null;
    if ($request->current_weight && $heightInMeters > 0) {
        $bmi = round($request->current_weight / ($heightInMeters ** 2), 2);
    }

    // Insert the new health status data
    HealthStatus::create([
        'user_id' => $userId,
        'blood_glucose' => $request->blood_glucose,
        'cholesterol_level' => $request->cholesterol_level,
        'sleep' => $request->sleep,
        'water_intake' => $request->water_intake,
        'start_weight' => $startWeight,
        'current_weight' => $request->current_weight,
        'goal_weight' => $request->goal_weight,
        
    ]);

    return redirect()->back()->with('success', 'Health status updated successfully.');
}

    
}

