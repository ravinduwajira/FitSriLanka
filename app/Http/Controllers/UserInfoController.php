<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;


class UserInfoController extends Controller
{
    public function UserInfo(Request $request)
    {
   //     $id = Auth::user()->id;
   //     $profileData = User::find($id); ,compact('profileData')
      return view('UserInfoRegister');
    }  

    public function UserInfoStore(Request $request)
{
    // Get the authenticated user ID
    $id = Auth::user()->id;
    $userInfo = new UserInfo(); // Use $userInfo consistently

    $userInfo->id = $id; // Now this will work

    $userInfo->birthday = $request->birthday;
    $userInfo->age = $request->age;
    $userInfo->height_cm = $request->height;
    $userInfo->weight_kg = $request->weight;
    $userInfo->activity_level = $request->activity_level;
    $userInfo->fitness_goal = $request->fitness_goal;
    $userInfo->dietary_preference = $request->dietary_preference;
    $userInfo->medical_conditions = $request->medical_conditions;


    $userInfo->save();

    return redirect()->route('dashboard')->with('success', 'Fitness info saved successfully!');

}

}
