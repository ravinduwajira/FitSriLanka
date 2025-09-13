<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function professionalRevenue()
    {
        $professionalId = Auth::user()->id;
        $id = Auth::user()->id;
        $profileData = User::find($id);

        // Fetch all payments related to the professional
        $payments = Payment::where('professional_id', $professionalId)->get();
    
        // Total Revenue
        $totalRevenue = $payments->sum('amount');
    
        // Total Admin Deductions
        $adminDeductions = $payments->sum('admin_charge');
    
        // Net Revenue
        $netRevenue = $totalRevenue - $adminDeductions;
    
        // Current Month's Revenue
        $currentMonth = Carbon::now()->format('Y-m');
        $currentMonthPayments = Payment::where('professional_id', $professionalId)
            ->whereYear('payment_date', Carbon::now()->year)
            ->whereMonth('payment_date', Carbon::now()->month)
            ->get();
    
        $currentMonthRevenue = $currentMonthPayments->sum('amount');
        $currentMonthAdminDeductions = $currentMonthPayments->sum('admin_charge');
        $currentMonthNetRevenue = $currentMonthRevenue - $currentMonthAdminDeductions;
    
        // Revenue History (Previous Months)
        $revenues = Payment::where('professional_id', $professionalId)
            ->selectRaw('DATE_FORMAT(payment_date, "%Y-%m") as month, SUM(amount) as total_revenue, SUM(admin_charge) as admin_deduction, SUM(amount - admin_charge) as net_revenue')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();
    
        return view('Professional.revenue', compact('totalRevenue', 'adminDeductions', 'netRevenue', 'currentMonthRevenue', 'currentMonthAdminDeductions', 'currentMonthNetRevenue', 'revenues','profileData'));
    }

    public function adminRevenue(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        // All Time Revenue and Profit
        $allTimeRevenue = Payment::sum('amount');
        $allTimeProfit = Payment::sum('admin_charge');

        // This Month's Revenue and Profit
        $thisMonth = Carbon::now()->month;
        $thisMonthRevenue = Payment::whereMonth('payment_date', $thisMonth)->sum('amount');
        $thisMonthProfit = Payment::whereMonth('payment_date', $thisMonth)->sum('admin_charge');

        // Previous Month's Revenue and Profit
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousMonthRevenue = Payment::whereMonth('payment_date', $previousMonth)->sum('amount');
        $previousMonthProfit = Payment::whereMonth('payment_date', $previousMonth)->sum('admin_charge');

        // Revenue Overview by Professionals
        $professionalRevenues = Payment::with('professional')
            ->selectRaw('professional_id, SUM(amount) as total_revenue, SUM(admin_charge) as admin_deduction')
            ->groupBy('professional_id')
            ->get();

        // Month-by-Month Revenue Overview
        $monthlyRevenues = Payment::selectRaw('DATE_FORMAT(payment_date, "%Y-%m") as month, SUM(amount) as total_revenue, SUM(admin_charge) as net_revenue')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => ['total_revenue' => $item->total_revenue, 'net_revenue' => $item->net_revenue]];
            });

        return view('Admin.revenue', compact(
            'allTimeRevenue',
            'allTimeProfit',
            'thisMonthRevenue',
            'thisMonthProfit',
            'previousMonthRevenue',
            'previousMonthProfit',
            'professionalRevenues',
            'monthlyRevenues',
            'profileData'
        ));
}
}