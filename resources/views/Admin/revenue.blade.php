@extends('Admin.admin_dashboard')

@section('Admin')
<div class="container my-5">
    <br>
    <br>
    <h2 class="text-center mb-4">Admin Revenue Dashboard 💵</h2>

    <!-- Revenue Summary Cards -->
    <div class="row g-4">
        @php
            $cards = [
                ['title' => 'All Time Revenue', 'amount' => $allTimeRevenue],
                ['title' => 'All Time Profit', 'amount' => $allTimeProfit],
                ['title' => "This Month's Revenue", 'amount' => $thisMonthRevenue],
                ['title' => "This Month's Profit", 'amount' => $thisMonthProfit],
                ['title' => "Previous Month's Revenue", 'amount' => $previousMonthRevenue],
                ['title' => "Previous Month's Profit", 'amount' => $previousMonthProfit],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-semibold">{{ $card['title'] }}</h4>
                        <p class="fs-3 fw-bold text-success">Rs. {{ number_format($card['amount'], 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Revenue Overview by Professionals -->
    <h4 class="mt-5 mb-3">Revenue Overview by Professionals</h4>
    @if($professionalRevenues->isEmpty())
        <div class="alert alert-info">No revenue data available for professionals.</div>
    @else
        <table class="table table-hover shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Professional</th>
                    <th>Total Revenue</th>
                    <th>Admin Deduction</th>
                    <th>Net Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professionalRevenues as $revenue)
                    <tr>
                        <td>{{ $revenue->professional->name }}</td>
                        <td>Rs. {{ number_format($revenue->total_revenue, 2) }}</td>
                        <td>Rs. {{ number_format($revenue->admin_deduction, 2) }}</td>
                        <td>Rs. {{ number_format($revenue->total_revenue - $revenue->admin_deduction, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Month-by-Month Revenue Overview -->
    <h4 class="mt-5 mb-3">Month-by-Month Revenue Overview</h4>
    @if(empty($monthlyRevenues))
        <div class="alert alert-info">No monthly revenue data available.</div>
    @else
        <table class="table table-hover shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Month</th>
                    <th>Total Revenue</th>
                    <th>Net Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monthlyRevenues as $month => $data)
                    <tr>
                        <td>{{ $month }}</td>
                        <td>Rs. {{ number_format($data['total_revenue'], 2) }}</td>
                        <td>Rs. {{ number_format($data['total_revenue'] - $data['net_revenue'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
