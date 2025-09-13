<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfessionalEnrollment;
use App\Models\WorkoutPlan;
use App\Models\FitnessCenter;
use App\Models\MealPlan;
use App\Models\Meal;
use App\Models\ProfessionalInfo;
use App\Models\Payment;
use Carbon\Carbon;

class ProfessionalController extends Controller
{
    public function ProfessionalDashboard()
    {
        $id = Auth::user()->id;
         
        // Fetch the user's profile data
        $profileData = User::find($id);
        
        // Fetch the professional's info
        $professionalInfo = ProfessionalInfo::where('id', $id)->first();

        
        // Fetch all payments related to the professional
        $payments = Payment::where('professional_id', $id)->get();
    
         // Current Month's Revenue
         $currentMonth = Carbon::now()->format('Y-m');
         $currentMonthPayments = Payment::where('professional_id', $id)
             ->whereYear('payment_date', Carbon::now()->year)
             ->whereMonth('payment_date', Carbon::now()->month)
             ->get();
     
         $currentMonthRevenue = $currentMonthPayments->sum('amount');

        // Total Revenue
        $totalRevenue = $payments->sum('amount');
        
        // Count of enrolled clients
        $enrollmentCount = ProfessionalEnrollment::where('professional_id', $id)->count();
        
        // Count of fitness centers associated with the professional
        $fitnessCenters = FitnessCenter::where('professional_id', $id)->count();
        
        // Fetch meal plans associated with the professional
        $mealPlans = MealPlan::where('professional_id', $id)->get();
        
        // Initialize meal count
        $mealscount = 0;
        
        // Calculate total meals count if meal plans exist
        if ($mealPlans->isNotEmpty()) {
            foreach ($mealPlans as $mealPlan) {
                $mealscount += Meal::where('meal_plan_id', $mealPlan->id)->count();
            }
        }
        
        // Count of issued workout plans
        $workoutPlanCount = WorkoutPlan::where('professional_id', $id)->count();
        
        // Pass data to the view, including professional info
        return view('Professional.index', compact('totalRevenue','currentMonthRevenue','profileData', 'enrollmentCount', 'fitnessCenters', 'mealscount', 'workoutPlanCount', 'professionalInfo'));
    }
    

    public function ManageClients() {
        $id = Auth::user()->id; // Get the authenticated user's ID (professional ID)
        $profileData = User::find($id); // Get the profile data of the authenticated user
        $EnrollmentData = ProfessionalEnrollment::where('professional_id', $id)->get()
                                                ->where('enrollment_status', 'enrolled'); // Fetch enrollment data where professional_id matches the authenticated user's ID
    
        return view('Professional.ManageClients', compact('profileData', 'EnrollmentData','profileData')); // Pass both profile and enrollment data to the view
    }
    
 
    public function ProfessionalLogin()
    {
        return view('login');

    }

    public function ProfessionalLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function ProfessionalProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('Professional.Professional_Profile',compact('profileData'));

    }

    public function ProfessionalProfileStore(Request $request)
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

public function ManageFitnessCenter()
{
    $id = Auth::user()->id;
    $profileData = User::find($id);
    return view('Professional.managefitnesscenter',compact('profileData'));

}

public function ManageDietPlan()
{
    $professionalId = Auth::id();  // Get the authenticated professional's ID

    // Retrieve the professional's profile data
    $profileData = User::find($professionalId);

    // Find the enrolled clients for this professional from the professional_enrollments table
    $clients = ProfessionalEnrollment::where('professional_id', $professionalId)
                                     ->where('enrollment_status', 'enrolled')  // Add condition for 'enrolled' status
                                     ->with('user')  // Load the related User (client)
                                     ->get()
                                     ->pluck('user');  // Extract the User model (clients)

    // Pass both the profile data and the clients to the view
    return view('Professional.managedietplans', compact('profileData', 'clients'));
}

public function ManageWorkoutPlan(Request $request)
{
    
    $professionalId = Auth::id();  // Get the authenticated professional's ID

    // Retrieve the professional's profile data
    $profileData = User::find($professionalId);

    // Find the enrolled clients for this professional from the professional_enrollments table
    $enrolledClients = ProfessionalEnrollment::where('professional_id', $professionalId)
                                     ->where('enrollment_status', 'enrolled')  // Add condition for 'enrolled' status
                                     ->with('user')  // Load the related User (client)
                                     ->get()
                                     ->pluck('user');  // Extract the User model (clients)

                                     $clientId = $request->input('client_id');
                                     $workoutPlan = null;
                                 
                                     if ($clientId) {
                                         $workoutPlan = WorkoutPlan::where('client_id', user_id)->first();
                                     }

    // Pass both the profile data and the clients to the view
    return view('Professional.manageworkout', compact('profileData', 'enrolledClients','workoutPlan', 'clientId'));
    

}
}
