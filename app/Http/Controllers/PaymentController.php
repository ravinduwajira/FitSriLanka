<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Professionalinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfessionalEnrollment;
use App\Models\FitnessCenterEnrollment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $id = $user->id;
    $profileData = User::find($id);
 // Get the authenticated user's ID
 $userId = Auth::id();

 // Fetch the professional enrollment record for the client where enrollment_status is 'enrolled'
$professionalData = ProfessionalEnrollment::where('user_id', $userId)
->where('enrollment_status', 'enrolled')
->first();

 // Fetch the monthly fee from the professional info if the professional is assigned
 $professionalFee = 0; // Default value

 if ($professionalData) {
     $professionalInfo = Professionalinfo::where('id', $professionalData->professional_id)->first();
     $professionalFee = $professionalInfo ? $professionalInfo->monthly_fee : 0;
 }

    // Fetch assigned fitness center data
    $fitnessCenterEnrollment = FitnessCenterEnrollment::where('user_id', $id)
        ->with('fitnessCenter')
        ->first();

    $fitnessCenterName = $fitnessCenterEnrollment ? $fitnessCenterEnrollment->fitnessCenter->name : null;
    $fitnessCenterFee = $fitnessCenterEnrollment ? $fitnessCenterEnrollment->fitnessCenter->monthly_fee : 0;

    // Calculate total payment due
    $paymentDue = $professionalFee + $fitnessCenterFee;

    // Fetch payment history for the authenticated user
 $payments = Payment::where('user_id', $userId)->get();

   // Check if a payment has been made for the current month
 $currentMonth = Carbon::now()->month;
 $currentYear = Carbon::now()->year;
 $paymentExists = Payment::where('user_id', $userId)
     ->whereMonth('payment_date', $currentMonth)
     ->whereYear('payment_date', $currentYear)
     ->exists();

    // Set payment due to 0 if payment has been made for the current month
 if ($paymentExists) {
    $paymentDue = 0;
}

    return view('payments', [
       
        'professionalFee' => $professionalFee,
        'fitnessCenterName' => $fitnessCenterName,
        'fitnessCenterFee' => $fitnessCenterFee,
        'paymentDue' => $paymentDue,
        'paymentExists' => $paymentExists,
        'payments' => $payments,
        'profileData' => $profileData,
        'professionalData' => $professionalData
    ]);
}

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'professional_id' => 'required|exists:professionalinfo,id',
        ]);

        // Create a new payment record
        Payment::create([
            'user_id' => Auth::id(),
            'professional_id' => $request->professional_id,
            'amount' => $request->amount,
            'admin_charge' => 300.00,
            'payment_date' => now(),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Payment successful!');
    }
}
