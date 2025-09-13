<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\User;
use App\Models\ProfessionalEnrollment;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkoutHistory;
use Carbon\Carbon;


class WorkoutPlanController extends Controller
{
    public function storeWorkoutPlan(Request $request)
{
    // Validate the request
    $request->validate([
        'workout_schedule' => 'required',
        'calorie_burn' => 'required',
        'workout_benefits' => 'required',
        'workout_duration' => 'required',
        'workout_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'workout_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10000',
    ]);

    $workoutPlan = new WorkoutPlan();

    // Update the workout plan fields
    $workoutPlan->professional_id = Auth::id();
    $workoutPlan->client_id = $request->user_id;
    $workoutPlan->workout_schedule = $request->workout_schedule;
    $workoutPlan->calorie_burn = $request->calorie_burn;
    $workoutPlan->workout_benefits = $request->workout_benefits;
    $workoutPlan->workout_duration = $request->workout_duration;
    $workoutPlan->additional_info = $request->additional_info;
    

    // Handle image upload
    if ($request->hasFile('workout_image')) {
        // If a previous image exists, delete it
        if (!empty($workoutPlan->workout_image) && file_exists(public_path('assets/upload/workout_images/' . $workoutPlan->workout_image))) {
            unlink(public_path('assets/upload/workout_images/' . $workoutPlan->workout_image));
        }

        // Process the new image
        $file = $request->file('workout_image');
        $imageName = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('assets/upload/workout_images'), $imageName);

        // Store the new image path
        $workoutPlan->workout_image = $imageName;
    }

    // Handle video upload
    if ($request->hasFile('workout_video')) {
        // If a previous video exists, delete it
        if (!empty($workoutPlan->workout_video) && file_exists(public_path('assets/upload/workout_videos/' . $workoutPlan->workout_video))) {
            unlink(public_path('assets/upload/workout_videos/' . $workoutPlan->workout_video));
        }

        // Process the new video
        $videoFile = $request->file('workout_video');
        $videoName = date('YmdHi') . $videoFile->getClientOriginalName();
        $videoFile->move(public_path('assets/upload/workout_videos'), $videoName);

        // Store the new video path
        $workoutPlan->workout_video = $videoName;
    }

    // Save the workout plan
    $workoutPlan->save();

    return redirect()->back()->with('success', 'Workout Plan Assigned Successfully');
}

public function workoutupdate(Request $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'workout_schedule' => 'required|string',
            'calorie_burn' => 'required|int',
            'workout_benefits' => 'required|string',
            'workout_duration' => 'required|string',
            'additional_info' => 'nullable|string',
            'workout_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'workout_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10000',
        ]);

        // Fetch the workout plan for the selected client
        $workoutPlan = WorkoutPlan::where('client_id', $request->user_id)->first();

        if (!$workoutPlan) {
            return redirect()->back()->with('error', 'Workout plan not found for the selected client.');
        }

        // Log the workout plan to verify
        \Log::info('Workout Plan found:', ['workoutPlan' => $workoutPlan]);

        // Update workout plan fields
        $workoutPlan->workout_schedule = $validatedData['workout_schedule'];
        $workoutPlan->calorie_burn = $validatedData['calorie_burn'];
        $workoutPlan->workout_benefits = $validatedData['workout_benefits'];
        $workoutPlan->workout_duration = $validatedData['workout_duration'];
        $workoutPlan->additional_info = $validatedData['additional_info'];
       
        // Handle image upload
        if ($request->hasFile('workout_image')) {
            // Log the image upload attempt
            \Log::info('Image upload detected.');

            // If a previous image exists, delete it
            if ($workoutPlan->workout_image && file_exists(public_path('assets/upload/workout_images/' . $workoutPlan->workout_image))) {
                unlink(public_path('assets/upload/workout_images/' . $workoutPlan->workout_image));
            }

            // Process the new image
            $file = $request->file('workout_image');
            $imageName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('assets/upload/workout_images'), $imageName);
            $workoutPlan->workout_image = $imageName;
        }

        // Handle video upload
        if ($request->hasFile('workout_video')) {
            // Log the video upload attempt
            \Log::info('Video upload detected.');

            // If a previous video exists, delete it
            if ($workoutPlan->workout_video && file_exists(public_path('assets/upload/workout_videos/' . $workoutPlan->workout_video))) {
                unlink(public_path('assets/upload/workout_videos/' . $workoutPlan->workout_video));
            }

            // Process the new video
            $videoFile = $request->file('workout_video');
            $videoName = date('YmdHi') . $videoFile->getClientOriginalName();
            $videoFile->move(public_path('assets/upload/workout_videos'), $videoName);
            $workoutPlan->workout_video = $videoName;
        }

        // Save the updated workout plan
        $workoutPlan->save();

        \Log::info('Workout Plan updated successfully.');

        return redirect()->back()->with('success', 'Workout Plan updated successfully!');

    } catch (\Exception $e) {
        // Log the detailed error message
        \Log::error('Error updating workout plan: ' . $e->getMessage());

        return redirect()->back()->with('error', 'Error updating workout plan. Please try again. Error: ' . $e->getMessage());
    }
}


 

    public function viewClientWorkoutPlan()
    {
        $client_id = Auth::id();
        $workoutPlan = WorkoutPlan::where('client_id', $client_id)->first();
 
        $workoutHistory = WorkoutHistory::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(7)
        ->get();


        $professionalData = ProfessionalEnrollment::where('user_id', $client_id)
                                                    ->where('enrollment_status', 'enrolled')
                                                    ->first();

        
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('workout', compact('workoutPlan', 'profileData', 'workoutHistory','professionalData'));
    }


    public function storeWorkoutHistory(Request $request)
    {
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
     

        WorkoutHistory::create([
            'user_id' => Auth::id(),
            'workout_plan_id' => $request->workout_plan_id,
            'workout_schedule' => $request->workout_schedule,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration' => $request->workout_duration_displayed,
        ]);

        return redirect()->back()->with('success', 'Workout history stored successfully');
    }

    public function getWorkoutPlan(Request $request)
{
    $professionalId = Auth::id();
    $clientId = $request->input('client_id');

    // Find the workout plan for the selected client if it exists
    $workoutPlan = WorkoutPlan::where('client_id', $clientId)
                               ->where('professional_id', $professionalId)
                               ->first();

    // Return workout plan details as JSON
    return response()->json($workoutPlan);
}


}

