<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\ProfessionalInfo;
use App\Models\ProfessionalEnrollment;
use App\Models\FitnessCenter;
use App\Models\FitnessCenterEnrollment;
use App\Models\MealPlan;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\fastingtracker;
use App\Models\HealthStatus;
use App\Models\WorkoutPlan;
use App\Models\WorkoutHistory;


class UserController extends Controller
{
    public function UserDashboard(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $user = auth()->user(); // Get authenticated user
        $lastHealthStatus = $user->healthStatuses()->latest()->first(); // Assuming relationship with health status
    
        // Fetch the meal plan for the authenticated user
        $mealPlan = MealPlan::where('user_id', $id)
            ->orderBy('id', 'desc') // or 'created_at' if you prefer
            ->first();
    
        // Check if meal plan exists
        if (!$mealPlan) {
            // If no meal plan, you can either redirect or set default values for the view
            return view('index', [
                'profileData' => $profileData,
                'lastHealthStatus' => $lastHealthStatus,
                'mealToShow' => null, // No meal to show
                'fastingOptions' => [], // No fasting options available
                'isFasting' => false,
                'progress' => 0,
                'ongoingFast' => null,
                'currentFast' => 'None',
                'elapsedTime' => null,
                'leftTime' => null,
                'CalorieIntake' => 0, // Default value for Calorie Intake
                'CalorieBurn' => 0, // Default value for Calorie Burn
                 'workoutDuration' => 0 // Default value for workout duration
            ]);
        }
    
        // Fetch today's meals for the meal plan
        $todayMeals = Meal::where('meal_plan_id', $mealPlan->id)
                        ->whereDate('date', Carbon::today())
                        ->get();

                        $CalorieIntake=0;
                        $CalorieIntake = $todayMeals->sum('calorie_count');
    
        // Get current time to determine which meal to show
        $currentTime = Carbon::now();
        $mealToShow = null;
    
        // Determine the meal to display based on the time
        $currentHour = $currentTime->hour;
    
        if ($currentHour >= 2 && $currentHour < 12) { 
            $mealToShow = $todayMeals->where('meal_time', 'Breakfast')->first();
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $mealToShow = $todayMeals->where('meal_time', 'Lunch')->first();
        } elseif ($currentHour >= 18 && $currentHour < 23) {
            $mealToShow = $todayMeals->where('meal_time', 'Dinner')->first();
        }
    
        // Predefined fasting options
        $fastingOptions = [
            [
                'id' => 1,
                'name' => '16/8 Fasting',
                'description' => 'Fast for 16 hours, eat during an 8-hour window.',
                'image_url' => 'https://i.ibb.co/RztrsNq/16-8-Intermittent-Fasting.png'
            ],
            [
                'id' => 2,
                'name' => '12/12 Fasting',
                'description' => 'Fast for 12 hours, eat for 12 hours.',
                'image_url' => 'https://i.ibb.co/nfK0G04/12-12-Intermittent-Fasting.png'
            ],
            [
                'id' => 3,
                'name' => '14/10 Fasting',
                'description' => 'Fast for 14 hours, eat during a 10-hour window.',
                'image_url' => 'https://i.ibb.co/cN19BjW/14-10-Intermittent-Fasting.png'
            ],
            [
                'id' => 4,
                'name' => '18/6 Fasting',
                'description' => 'Fast for 18 hours, eat during a 6-hour window.',
                'image_url' => 'https://i.ibb.co/RhxJ0jB/12-12-Intermittent-Fasting.png'
            ],
            [
                'id' => 5,
                'name' => '20/4 Fasting',
                'description' => 'Fast for 20 hours, eat during a 4-hour window.',
                'image_url' => 'https://i.ibb.co/tb7F7QS/20-4-Intermittent-Fasting.png'
            ],
            [
                'id' => 6,
                'name' => '22/2 Fasting',
                'description' => 'Fast for 22 hours, eat during a 2-hour window.',
                'image_url' => 'https://i.ibb.co/r0fBTMg/22-2-Intermittent-Fasting.png'
            ]
        ];
    
        $elapsedTime = null;
        $leftTime = null;
    
        // Check if the user is currently fasting
        $ongoingFast = DB::table('fastingtrackers')
            ->where('user_id', $id)
            ->whereNull('end_time')
            ->first();
    
        // Default progress, fasting state, and current fast
        $isFasting = false;
        $progress = 0;
        $currentFast = 'None'; // Default value if no fast is ongoing
    
        if ($ongoingFast) {
            $isFasting = true;
    
            // Find the fasting option based on ongoingFast fast_id
            $fastOption = collect($fastingOptions)->firstWhere('name', $ongoingFast->fasting_plan);
    
            if ($fastOption) {
                $currentFast = $fastOption['name']; // Set the name of the current fast
            }
    
            if ($fastOption['name'] === '16/8 Fasting') {
                $totalFastingDuration = 16 * 3600;
            } elseif ($fastOption['name'] === '12/12 Fasting') {
                $totalFastingDuration = 12 * 3600;
            } elseif ($fastOption['name'] === '14/10 Fasting') {
                $totalFastingDuration = 14 * 3600;
            } elseif ($fastOption['name'] === '18/6 Fasting') {
                $totalFastingDuration = 18 * 3600;
            } elseif ($fastOption['name'] === '20/4 Fasting') {
                $totalFastingDuration = 20 * 3600;
            } elseif ($fastOption['name'] === '22/2 Fasting') {
                $totalFastingDuration = 22 * 3600;
            }
    
            // Calculate elapsed time in seconds
            $startTime = strtotime($ongoingFast->start_time);
            $currentTime = time();
            $elapsedTime = $currentTime - $startTime;
            $leftTime = $totalFastingDuration -  $elapsedTime;
    
            // Calculate progress percentage
            $progress = min(($elapsedTime / $totalFastingDuration) * 100, 100);
            $progress = number_format($progress, 2);
        }
    
        $workoutPlans = WorkoutPlan::where('client_id', $id)->get();
        $calorieBurn=null;
        foreach ($workoutPlans as $workoutPlan) {
            $CalorieBurn = $workoutPlan->calorie_burn;
        }

      

        $workoutHistory = WorkoutHistory::where('user_id', $id)
        ->whereDate('start_time', Carbon::today())
        ->get();
        $workoutDuration =0;
        
        function timeToSeconds($time) {
            list($hours, $minutes, $seconds) = explode(':', $time);
            return $hours * 3600 + $minutes * 60 + $seconds;
        }
        
        // Sum the 'duration' column by converting each duration into seconds
        $totalSeconds = $workoutHistory->sum(function($history) {
            return timeToSeconds($history->duration);
        });
        
        // Convert total seconds back to H:i:s format
        $workoutDuration = gmdate('H:i:s', $totalSeconds);

        return view('index', compact('profileData', 'lastHealthStatus', 'mealToShow', 'fastingOptions', 'isFasting', 'progress', 'ongoingFast', 'currentFast', 'elapsedTime', 'leftTime','CalorieIntake','CalorieBurn','workoutDuration'));
    }
    
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('User_Profile',compact('profileData'));

    }

    public function UserProfileStore(Request $request)
{
    $id = Auth::user()->id;
    $data = User::find($id);

    // Update user information
    $data->username = $request->username;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->address = $request->address;

    // Only update the photo if a new one has been uploaded
    if ($request->hasFile('photo')) {
        // Delete old photo if it exists
        if (!empty($data->photo) && file_exists(public_path('upload/admin_images/' . $data->photo))) {
            unlink(public_path('upload/admin_images/' . $data->photo));
        }

        // Process the new photo
        $file = $request->file('photo');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $filename);

        $data->photo = $filename; // Update with the new filename
    }

    // Save the updated profile
    $data->save();

    return redirect()->back()->with('success', 'Profile updated successfully');
}
public function HealthStatus()
{
    $id = Auth::id(); // Shortcut for Auth::user()->id

    // Retrieve the user's profile data
    $profileData = User::findOrFail($id); // Using findOrFail to ensure user exists

    // Retrieve the latest health status for this user
    $latestStatus = HealthStatus::where('user_id', $id)
        ->latest()
        ->first();

    // Retrieve all health status records for this user
    $AllStatus = HealthStatus::where('user_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Retrieve height info for the user
    $heightInfo = UserInfo::where('id', $id)->first();

    // Handle the case where height info might be missing
    $height = $heightInfo ? $heightInfo->height_cm : null;

    // Calculate BMI if height and current weight are available
    $bmi = null;
    if ($height && $latestStatus && $latestStatus->current_weight) {
        $heightInMeters = $height / 100;
        $bmi = round($latestStatus->current_weight / ($heightInMeters * $heightInMeters), 2);
    }

    return view('health_status', compact('profileData', 'latestStatus', 'AllStatus', 'height', 'bmi'));
}





    public function DietPlan()
{
    $userId = Auth::user()->id;

    // Fetch the meal plan where user_id matches the authenticated user
    $mealPlan = MealPlan::where('user_id', $userId)
            ->orderBy('id', 'desc') // or 'created_at' if you prefer
            ->first();


    // If a meal plan exists, fetch the associated meals
    if ($mealPlan) {
        $meals = Meal::where('meal_plan_id', $mealPlan->id)->get();
    } else {
        $meals = collect();  // Initialize as an empty collection if no meal plan exists
    }

    // Fetch profile data
    $profileData = User::find($userId);

    // Pass the meals and profile data to the view
    return view('dietplan', compact('meals', 'profileData'));
}


    public function FastingTracker()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
    
        // Predefined fasting options
        $fastingOptions = [
            [
                'id' => 1,
                'name' => '16/8 Fasting',
                'description' => 'Fast for 16 hours, eat during an 8-hour window.',
                'image_url' => 'https://i.ibb.co/RztrsNq/16-8-Intermittent-Fasting.png'
            ],
            [
                'id' => 2,
                'name' => '12/12 Fasting',
                'description' => 'Fast for 12 hours, eat for 12 hours.',
                'image_url' => 'https://i.ibb.co/nfK0G04/12-12-Intermittent-Fasting.png'
            ],
            [
                'id' => 3,
                'name' => '14/10 Fasting',
                'description' => 'Fast for 14 hours, eat during a 10-hour window.',
                'image_url' => 'https://i.ibb.co/cN19BjW/14-10-Intermittent-Fasting.png'
            ],
            [
                'id' => 4,
                'name' => '18/6 Fasting',
                'description' => 'Fast for 18 hours, eat during a 6-hour window.',
                'image_url' => 'https://i.ibb.co/RhxJ0jB/12-12-Intermittent-Fasting.png'
            ],
            [
                'id' => 5,
                'name' => '20/4 Fasting',
                'description' => 'Fast for 20 hours, eat during a 4-hour window.',
                'image_url' => 'https://i.ibb.co/tb7F7QS/20-4-Intermittent-Fasting.png'
            ],
            [
                'id' => 6,
                'name' => '22/2 Fasting',
                'description' => 'Fast for 22 hours, eat during a 2-hour window.',
                'image_url' => 'https://i.ibb.co/r0fBTMg/22-2-Intermittent-Fasting.png'
            ]
        ];
    
        $elapsedTime = null;
        $leftTime = null;
    
        // Check if the user is currently fasting
        $ongoingFast = DB::table('fastingtrackers')
            ->where('user_id', $id)
            ->whereNull('end_time')
            ->first();
    
        // Default progress, fasting state, and current fast
        $isFasting = false;
        $progress = 0;
        $currentFast = 'None'; // Default value if no fast is ongoing
    
        if ($ongoingFast) {
            $isFasting = true;
    
            // Find the fasting option based on ongoingFast fast_id
            $fastOption = collect($fastingOptions)->firstWhere('name', $ongoingFast->fasting_plan);
    
            if ($fastOption) {
                $currentFast = $fastOption['name']; // Set the name of the current fast
            }
    
            if ($fastOption['name'] === '16/8 Fasting') {
                $totalFastingDuration = 16 * 3600;
            } elseif ($fastOption['name'] === '12/12 Fasting') {
                $totalFastingDuration = 12 * 3600;
            } elseif ($fastOption['name'] === '14/10 Fasting') {
                $totalFastingDuration = 14 * 3600;
            } elseif ($fastOption['name'] === '18/6 Fasting') {
                $totalFastingDuration = 18 * 3600;
            } elseif ($fastOption['name'] === '20/4 Fasting') {
                $totalFastingDuration = 20 * 3600;
            } elseif ($fastOption['name'] === '22/2 Fasting') {
                $totalFastingDuration = 22 * 3600;
            }
    
            // Calculate elapsed time in seconds
            $startTime = strtotime($ongoingFast->start_time);
            $currentTime = time();
            $elapsedTime = $currentTime - $startTime;
            $leftTime = $totalFastingDuration -  $elapsedTime;
    
            // Calculate progress percentage
            $progress = min(($elapsedTime / $totalFastingDuration) * 100, 100);
            $progress = number_format($progress, 2);
        }

        $fastingHistory = fastingtracker::where('user_id', $id)->get();
    
        return view('fastingtracker', compact('profileData', 'fastingOptions', 'isFasting', 'progress', 'ongoingFast', 'currentFast','elapsedTime','leftTime','fastingHistory'));
    }
    

    
    
    public function ProfessionalList()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Retrieve all records from the professionallinfo table
        $professionalData = ProfessionalInfo::all();
        
        // Pass the data to the view
        return view('professionallist', ['professionalData'=>$professionalData,'profileData'=>$profileData ]);
    }
    
    public function toggleEnrollment(Request $request)
{
    $userId = Auth::id();
    $professionalId = $request->input('professional_id');
    $professionalName = $request->input('professional_name');

    // Check if the user is already enrolled
    $enrollment = ProfessionalEnrollment::where('professional_id', $professionalId)
        ->where('user_id', $userId)
        ->first();

    if ($enrollment) {
        // Update existing enrollment status
        $enrollment->enrollment_status = $enrollment->enrollment_status === 'enrolled' ? 'unenrolled' : 'enrolled';
        $enrollment->save();
    } else {
        // Create a new enrollment entry
        ProfessionalEnrollment::create([
            'professional_id' => $professionalId,
            'professional_name' => $professionalName,
            'user_id' => $userId,
            'name' => Auth::user()->name,
            'enrollment_status' => 'enrolled'
        ]);
    }

    return redirect()->back()->with('success', 'Enrollment status updated successfully.');
}

public function FitnessCenterEnroll()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $fitnessCenters = FitnessCenter::get();
        return view('fitnesscenterenroll',compact('profileData','fitnessCenters'));

    }

public function toggleFitnessCenterEnrollment(Request $request)
{
    $enrollment = FitnessCenterEnrollment::where('fitness_center_id', $request->fitness_center_id)
        ->where('user_id', Auth::id())
        ->first();

    if ($request->enrollment_status === 'enrolled') {
        // Enroll the user
        if (!$enrollment) {
            FitnessCenterEnrollment::create([
                'fitness_center_id' => $request->fitness_center_id,
                'user_id' => Auth::id(),
                'User_name'=> $request->User_name,
                'enrollment_status' => 'enrolled',
            ]);
            return redirect()->back()->with('success', 'Successfully enrolled in the fitness center!');
        }
    } else {
        // Unenroll the user
        if ($enrollment) {
            $enrollment->delete();
            return redirect()->back()->with('success', 'Successfully unenrolled from the fitness center!');
        }
    }

    return redirect()->back()->with('error', 'An error occurred.');
}


}
