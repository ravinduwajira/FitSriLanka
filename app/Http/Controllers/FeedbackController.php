<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Models\ProfessionalFeedback;

class FeedbackController extends Controller
{
    public function storeUserFeedback(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'score' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:255',
        ]);

        UserFeedback::create([
            'user_id' => $request->user_id,
            'professional_id' => auth()->id(),
            'score' => $request->score,
            'feedback' => $request->feedback,
        ]);

        return back()->with('success', 'Feedback submitted successfully!');
    }

    public function storeProfessionalFeedback(Request $request)
    {
         // Validate the incoming request data
         $request->validate([
            'professional_id' => 'required|exists:users,id', // Ensure professional exists
            'score' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        // Create the feedback record
        ProfessionalFeedback::create([
            'professional_id' => $request->professional_id,
            'user_id' => auth()->user()->id,  // The currently authenticated user
            'score' => $request->score,
            'feedback' => $request->feedback,
        ]);

        // Optionally, you can redirect back with a success message
        return back()->with('success', 'Your feedback has been submitted successfully.');
    }
}
