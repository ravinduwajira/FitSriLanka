<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfessionalInfo;


class ProfessionalInfoController extends Controller
{
    public function ProfessionalInfo(Request $request)
    {
      
      return view('Professional/ProfessionalInfoRegister');
    }  

    public function ProfessionalInfoStore(Request $request)
{
    // Get the authenticated user ID
    $id = Auth::user()->id;
    $professionalInfo = new ProfessionalInfo();

    // Assign values to fields
    $professionalInfo->id = $id; // Set user ID
    $professionalInfo->birthday = $request->birthday;
    $professionalInfo->age = $request->age;
    $professionalInfo->certifications = $request->certifications;
    $professionalInfo->experience = $request->experience;
    $professionalInfo->specializations = $request->specializations;
    $professionalInfo->bio = $request->bio;
    $professionalInfo->programs = $request->programs;
    $professionalInfo->monthly_fee = $request->monthly_fee;

    // Save the ProfessionalInfo
    $professionalInfo->save();

    // Redirect with a success message
    return redirect('/Professional/dashboard')->with('success', 'Professional info saved successfully!');
}
public function update(Request $request)
{
    $request->validate([
        'certifications' => 'nullable|string',
        'experience' => 'nullable|numeric',
        'specializations' => 'nullable|string',
        'bio' => 'nullable|string',
        'programs' => 'nullable|string',
        'monthly_fee' => 'nullable|numeric',
    ]);

    // Fetch the authenticated user's professional info
    $professionalInfo = ProfessionalInfo::where('id', Auth::id())->first();

    if ($professionalInfo) {
        // Update the professional info
        $professionalInfo->update([
            'certifications' => $request->certifications,
            'experience' => $request->experience,
            'specializations' => $request->specializations,
            'bio' => $request->bio,
            'programs' => $request->programs,
            'monthly_fee' => $request->monthly_fee,
        ]);

        return redirect()->back()->with('success', 'Professional information updated successfully!');
    } else {
        return redirect()->back()->with('error', 'No professional information found.');
    }
}


}

