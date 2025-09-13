<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FitnessCenter;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FitnessCenterController extends Controller
{
      // Display the form and list of fitness centers
      public function index(Request $request)
      {
        $id = Auth::user()->id;
        $profileData = User::find($id);
          $fitnessCenters = FitnessCenter::where('professional_id', Auth::id())->get();
          $editingFitnessCenter = null;
  
          if ($request->has('edit_id')) {
              $editingFitnessCenter = FitnessCenter::find($request->edit_id);
          }
  
          return view('/Professional/fitnesscenters', compact('fitnessCenters', 'editingFitnessCenter','profileData'));
      }
  
      // Store or update a fitness center
      public function store(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'address' => 'required|string|max:255',
              'monthly_fee' => 'required|numeric|min:0',
          ]);
  
          if ($request->filled('fitnesscenterid')) {
              // Update existing fitness center
              $fitnessCenter = FitnessCenter::findOrFail($request->fitnesscenterid);
              $fitnessCenter->update([
                  'name' => $request->name,
                  'address' => $request->address,
                  'monthly_fee' => $request->monthly_fee,
              ]);
          } else {
              // Create new fitness center
              FitnessCenter::create([
                  'professional_id' => Auth::id(),
                  'name' => $request->name,
                  'address' => $request->address,
                  'monthly_fee' => $request->monthly_fee,
              ]);
          }
  
          return redirect()->route('Professional.fitnesscenter.index')->with('success', 'Fitness Center saved successfully');
      }
  
      // Delete a fitness center
      public function destroy($id)
      {
          $fitnessCenter = FitnessCenter::findOrFail($id);
          $fitnessCenter->delete();
  
          return redirect()->route('Professional.fitnesscenter.index')->with('success', 'Fitness Center deleted successfully');
      }

      public function update(Request $request, $id)
{
    $fitnessCenter = FitnessCenter::findOrFail($id);
    $fitnessCenter->update($request->all());

    return redirect()->route('Professional.fitnesscenter.index')->with('success', 'Fitness Center updated successfully!');
}

}
