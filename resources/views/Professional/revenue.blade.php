@extends('Professional.Professional_dashboard')

@section('Professional')
<br><br>
<div class="container my-5">
    <h2 class="text-center mb-4">My Revenue 💵</h2>

    <!-- Current Month's Revenue Summary -->
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body text-center bg-light">
                    <h4 class="mb-3">Current Month's Revenue - {{ \Carbon\Carbon::now()->format('F Y') }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Total Revenue</h5>
                            <p class="fs-4 fw-bold text-success">Rs. {{ number_format($currentMonthRevenue, 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Platform Charges</h5>
                            <p class="fs-4 fw-bold text-danger">Rs. {{ number_format($currentMonthAdminDeductions, 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Net Revenue</h5>
                            <p class="fs-4 fw-bold text-primary">Rs. {{ number_format($currentMonthNetRevenue, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Revenue Summary -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Total Revenue</h4>
                    <p class="fs-3 fw-bold">Rs. {{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Platform Charges</h4>
                    <p class="fs-3 fw-bold">Rs. {{ number_format($adminDeductions, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h4>Net Revenue</h4>
                    <p class="fs-3 fw-bold">Rs. {{ number_format($netRevenue, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue History -->
    <h4 class="mt-5 mb-3">Revenue History</h4>
    <table class="table table-hover shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Month</th>
                <th>Total Revenue</th>
                <th>Platform Charges</th>
                <th>Net Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revenues as $revenue)
            <tr>
                <td>{{ \Carbon\Carbon::parse($revenue->month)->format('F Y') }}</td>
                <td>Rs. {{ number_format($revenue->total_revenue, 2) }}</td>
                <td>Rs. {{ number_format($revenue->admin_deduction, 2) }}</td>
                <td>Rs. {{ number_format($revenue->net_revenue, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
