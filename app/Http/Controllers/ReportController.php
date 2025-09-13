<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthStatus;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class ReportController extends Controller
{
    // Existing method for user health reports
    public function showHealthReports()
    {
        $user = auth()->user();
        $lastHealthStatus = $user->healthStatuses()->latest()->first();

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('reports', compact('profileData', 'lastHealthStatus'));
    }

   
   
}
