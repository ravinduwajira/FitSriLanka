@extends('dashboard')

@section('User')
<br>
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold">Billing Summary 💳</h2>

    <!-- Payment Summary Card -->
    <div class="card mb-5 shadow-sm rounded-4">
        <div class="card-body p-5">
            <h4 class="fw-bold mb-4">Payment Breakdown for {{ \Carbon\Carbon::now()->format('F Y') }}</h4>

            <div class="row mb-3">
                <!-- Assigned Professional -->
                <div class="col-md-8">
                    <p class="mb-1 fs-5 text-muted">Assigned Professional</p>
                    <p class="fs-4 fw-bold">
                        {{ $professionalData->professional_name ?? 'No Professional Assigned' }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <p class="fs-5 fw-bold">
                        Rs. {{ number_format($professionalFee, 2) }}
                    </p>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <!-- Enrolled Fitness Center -->
                <div class="col-md-8">
                    <p class="mb-1 fs-5 text-muted">Enrolled Fitness Center</p>
                    <p class="fs-4 fw-bold">
                        {{ $fitnessCenterName ?? 'No Fitness Center Assigned' }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <p class="fs-5 fw-bold">
                        Rs. {{ number_format($fitnessCenterFee, 2) }}
                    </p>
                </div>
            </div>

            <hr class="border-2">

            <!-- Total Payment Due -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <p class="fs-3 fw-bold text-primary">Total Payment Due</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <p class="fs-3 fw-bold text-danger">
                        Rs. {{ number_format($paymentDue, 2) }}
                    </p>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="mt-5">
                @if ($paymentExists)
                    <button type="button" class="btn btn-secondary btn-lg w-100 py-3 fw-bold" disabled>
                        Payment Already Made for This Month
                    </button>
                @else
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="professional_id" value="{{ $professionalData->professional_id }}">
                        <input type="hidden" name="amount" value="{{ $paymentDue }}">

                        <!-- Card Details Section -->
                        <h5 class="mb-3 fw-bold">Enter Card Information</h5>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control p-3 rounded-3" name="cardholder_name" placeholder="Cardholder Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control p-3 rounded-3" name="card_number" placeholder="Card Number" maxlength="16" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control p-3 rounded-3" name="expiry_date" placeholder="MM/YY" maxlength="5" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control p-3 rounded-3" name="cvv" placeholder="CVV" maxlength="3" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control p-3 rounded-3" name="zip_code" placeholder="Zip Code" required>
                            </div>
                        </div>

                        <!-- Payment Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold">
                                <i class="feather icon-credit-card me-2"></i> Pay Now
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment History Section -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-5">
            <h4 class="fw-bold mb-4">Payment History</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm rounded-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Platform Charges</th>
                            <th>Net Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                            <td>Rs. {{ number_format($payment->amount, 2) }}</td>
                            <td>Rs. {{ number_format($payment->admin_charge, 2) }}</td>
                            <td>Rs. {{ number_format($payment->amount - $payment->admin_charge, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No payment history available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
