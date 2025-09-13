<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfessionalInfo;
use App\Models\UserFeedback;
use App\Models\ProfessionalFeedback;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfessionalEnrollment;

class LeaderboardController extends Controller
{
    // User leaderboard
    public function userLeaderboard()
    {
        $professionalId = Auth::id();

        // Fetch the authenticated professional's profile data
        $profileData = User::find($professionalId);

        // Fetch the clients assigned to the authenticated professional via the professional_enrollments table
        $assignedClients = ProfessionalEnrollment::where('professional_id', $professionalId)
            ->where('enrollment_status', 'enrolled')
            ->with('user')
            ->get()
            ->map(function ($enrollment) {
                return $enrollment->user;
            });

        // Get top 10 users based on average score from professional feedback
        $topUsers = User::withAvg('userFeedbacks as avg_score', 'score')
            ->where('role', 'User') // Filter by 'role' column in the 'users' table
            ->orderByDesc('avg_score')
            ->limit(10)
            ->get();

        // Fetch received feedback from the  user
            $receivedFeedbacks = ProfessionalFeedback::where('Professional_id', $professionalId)->get();

         
        return view('Professional.user_leaderboard', compact('topUsers', 'profileData', 'assignedClients', 'receivedFeedbacks'));
    }

    // Professional leaderboard
    public function professionalLeaderboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

            // Get the authenticated user
    $user = Auth::user()->id;

    // Fetch the professional assigned to the authenticated user via the professional_enrollments table
    $assignedProfessional = ProfessionalEnrollment::where('user_id', $user)
                                                    ->where('enrollment_status', 'enrolled')
                                                    ->first();
   
        // Get top 10 professionals based on average score from professional feedback
        $topProfessionals = User::withAvg('professionalFeedbacks as avg_score', 'score')
        ->where('role', 'Professional')  // Filter by 'role' column in the 'users' table
        ->orderByDesc('avg_score')
        ->limit(10)
        ->get();

         // Fetch feedback received by the professional
         $receivedFeedbacks = UserFeedback::where('user_id', $user)
         ->with('client')
         ->get();
         


        return view('professional_leaderboard', compact('topProfessionals','profileData','assignedProfessional','receivedFeedbacks'));
    }
}

