<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FitnessCenter;
use App\Models\WorkoutPlan;
use App\Models\MealPlan;
use App\Models\Payment;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $UserCount = User::where('role', 'User')->count();
        $ProfessionalCount = User::where('role', 'Professional')->count();
        $fitnessCenters = FitnessCenter::count();
        $WorkoutPlanCount = WorkoutPlan::count();
        $MealPlanCount = MealPlan::count();

        // All Time Revenue and Profit
        $allTimeRevenue = Payment::sum('amount');
        $allTimeProfit = Payment::sum('admin_charge');

        // This Month's Revenue and Profit
        $thisMonth = Carbon::now()->month;
        $thisMonthRevenue = Payment::whereMonth('payment_date', $thisMonth)->sum('amount');
        $thisMonthProfit = Payment::whereMonth('payment_date', $thisMonth)->sum('admin_charge');



        return view('Admin.index',compact('allTimeProfit','thisMonthProfit','thisMonthRevenue','allTimeRevenue','profileData','UserCount','ProfessionalCount','fitnessCenters','WorkoutPlanCount','MealPlanCount'));
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('Admin/login');
    }

    public function AdminLogin()
    {
        return view('Admin.admin_login');

    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('Admin.admin_profile',compact('profileData'));

    }

    public function AdminProfileStore(Request $request)
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

public function User_Manage(){
    $id = Auth::user()->id;
    $profileData = User::find($id);

    $users = User::where('role', 'User')->get();

// Pass users to the view
return view('Admin.User_Manage', compact('users','profileData'));
}
public function deleteUser($id)
{
    // Find the user by ID and delete the user
    $user = \App\Models\User::findOrFail($id);

    // Check if the user role is 'User' to ensure you don't delete other roles
    if ($user->role === 'User') {
        $user->delete();
        return redirect()->route('Admin.User_Manage')->with('success', 'User deleted successfully');
    }

    return redirect()->route('Admin.User_Manage')->with('error', 'Cannot delete this user');
}

public function Professional_Manage(){
    $id = Auth::user()->id;
    $profileData = User::find($id);

    $users = User::where('role', 'Professional')->get();

// Pass users to the view
return view('Admin.Professional_Manage', compact('users','profileData'));
}
public function deleteProfessional($id)
{
    // Find the user by ID and delete the user
    $user = \App\Models\User::findOrFail($id);

    // Check if the user role is 'User' to ensure you don't delete other roles
    if ($user->role === 'Professional') {
        $user->delete();
        return redirect()->route('Admin.Professional_Manage')->with('success', 'User deleted successfully');
    }

    return redirect()->route('Admin.Professional_Manage')->with('error', 'Cannot delete this user');
}


public function manageFitnessCenters()
{
    $fitnessCenters = FitnessCenter::all();

    $id = Auth::user()->id;
    $profileData = User::find($id);
    
    return view('Admin.FitnessCenter_Manage', compact('fitnessCenters','profileData'));
}

public function deleteFcenter($id)
{
    try {
        // Find the fitness center by its ID
        $fitnessCenter = FitnessCenter::findOrFail($id);
        
        // Delete the fitness center
        $fitnessCenter->delete();

        // Redirect with a success message
        return redirect()->route('Admin.manageFitnessCenters')->with('success', 'Fitness center removed successfully.');
    } catch (\Exception $e) {
        // Redirect with an error message if something goes wrong
        return redirect()->route('Admin.manageFitnessCenters')->with('error', 'Failed to remove fitness center.');
    }
}

}
