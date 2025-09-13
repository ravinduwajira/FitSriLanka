<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fastingtracker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class fastingcontroller extends Controller
{
    public function startFasting(Request $request, $plan)
{
    $userId = Auth::id();
    
    // Check if there's an ongoing fast for this user
    $existingFast = fastingtracker::where('user_id', $userId)->whereNull('end_time')->first();
    if ($existingFast) {
        return redirect()->back()->withErrors(['error' => 'You already have an ongoing fast.']);
    }

    // Assuming fastingOptions is an array of plans. Define it or fetch from DB.
    $fastingOptions = $this->getFastingOptions(); // Define this method or array if needed
    
    // Ensure the plan exists in fastingOptions
    if (!isset($fastingOptions[$plan])) {
        return redirect()->back()->withErrors(['error' => 'Invalid fasting plan selected.']);
    }

    $selectedFast = $fastingOptions[$plan];

    // Create new fasting entry
    $fast = new fastingtracker();
    $fast->user_id = $userId;
    $fast->fasting_plan = $selectedFast['name']; // Store the fasting plan name
    $fast->start_time = now();
    $fast->save();

    // Store the selected fast in the session as the current fast
    session(['currentFast' => $selectedFast['name']]);

    return redirect()->back()->with('message', 'Fasting started successfully');
}



public function endFasting(Request $request)
{
    $userId = Auth::id();

    // Find the ongoing fast for this user
    $ongoingFast = fastingtracker::where('user_id', $userId)->whereNull('end_time')->first();

    if (!$ongoingFast) {
        return redirect()->back()->withErrors(['error' => 'No ongoing fast found.']);
    }

    // Update the fasting entry with the end time and elapsed time
    $ongoingFast->end_time = now();
    $ongoingFast->duration = $request->input('elapsed_time');
    $ongoingFast->save();

    // Clear the current fast from the session
    session()->forget('currentFast');

    return redirect()->back()->with('message', 'Fasting ended successfully');
}


public function getFastingOptions()
{
    return [
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
}


}
