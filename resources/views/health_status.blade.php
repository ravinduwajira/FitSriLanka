@extends('dashboard')
@section('User')

<title>Update Health Status</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        box-shadow: 0px 0px 8px rgba(33, 150, 243, 0.3);
        border-color: #2196f3;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4CAF50, #66BB6A);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #43A047, #388E3C);
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        position: sticky;
        top: 0;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .icon-label {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .icon-label i {
        color: #2196f3;
    }

    .bmi-alert {
        padding: 10px;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .bmi-alert i {
        font-size: 18px;
    }

    .bmi-alert.success {
        background-color: #e8f5e9;
        color: #43A047;
    }

    .bmi-alert.warning {
        background-color: #fff3e0;
        color: #FF9800;
    }

    .bmi-alert.danger {
        background-color: #ffebee;
        color: #E53935;
    }

    .bmi-alert.neutral {
        background-color: #e3f2fd;
        color: #1E88E5;
    }
</style>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Update Health Status</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('health.status.store') }}">
                        @csrf

                        <!-- Blood Glucose -->
                        <div class="mb-3">
                            <label for="blood_glucose" class="form-label icon-label">
                                <i data-feather="droplet"></i> Blood Glucose (mg/dL)
                            </label>
                            <input id="blood_glucose" class="form-control" name="blood_glucose" type="number" value="{{ $latestStatus->blood_glucose ?? 0 }}">
                        </div>

                        <!-- Cholesterol Level -->
                        <div class="mb-3">
                            <label for="cholesterol_level" class="form-label icon-label">
                                <i data-feather="heart"></i> Cholesterol Level (mg/dL)
                            </label>
                            <input id="cholesterol_level" class="form-control" name="cholesterol_level" type="number" value="{{ $latestStatus->cholesterol_level ?? 0 }}">
                        </div>

                        <!-- Sleep -->
                        <div class="mb-3">
                            <label for="sleep" class="form-label icon-label">
                                <i data-feather="moon"></i> Sleep (Hours)
                            </label>
                            <input id="sleep" class="form-control" name="sleep" type="number" value="{{ $latestStatus->sleep ?? 0 }}">
                        </div>

                        <!-- Water Intake -->
                        <div class="mb-3">
                            <label for="water_intake" class="form-label icon-label">
                                <i data-feather="droplets"></i> Water Intake (Liters)
                            </label>
                            <input id="water_intake" class="form-control" name="water_intake" type="number" value="{{ $latestStatus->water_intake ?? 0 }}">
                        </div>

                        <!-- Height -->
                        <div class="mb-3">
                            <label for="height" class="form-label icon-label">
                                <i data-feather="arrow-up"></i> Height (CM)
                            </label>
                            <input id="height" class="form-control" name="height" type="number" value="{{ $height }}">
                        </div>

                        <!-- Start Weight (muted after first entry) -->
                        <div class="mb-3">
                            <label for="start_weight" class="form-label icon-label">
                                <i data-feather="play-circle"></i> Start Weight (kg)
                            </label>
                            <input id="start_weight" class="form-control" name="start_weight" type="number" value="{{ $latestStatus->start_weight ?? 0 }}" {{ $latestStatus && $latestStatus->start_weight ? 'disabled' : '' }}>
                        </div>

                        <!-- Current Weight -->
                        <div class="mb-3">
                            <label for="current_weight" class="form-label icon-label">
                                <i data-feather="activity"></i> Current Weight (kg)
                            </label>
                            <input id="current_weight" class="form-control" name="current_weight" type="number" value="{{ $latestStatus->current_weight ?? 0 }}">
                        </div>

                        <!-- Goal Weight -->
                        <div class="mb-3">
                            <label for="goal_weight" class="form-label icon-label">
                                <i data-feather="target"></i> Goal Weight (kg)
                            </label>
                            <input id="goal_weight" class="form-control" name="goal_weight" type="number" value="{{ $latestStatus->goal_weight ?? 0 }}">
                        </div>

                        <!-- BMI -->
                        <div class="mb-3">
                            <label for="bmi" class="form-label icon-label">
                                <i data-feather="clipboard"></i> BMI
                            </label>
                            <div class="d-flex flex-column">
                                <input id="bmi" class="form-control text-muted" type="text" value="{{ $bmi ?? 'N/A' }}" disabled>
                                <div id="bmi-alert" class="bmi-alert neutral">
                                    <i data-feather="info"></i> Calculate BMI to see the result.
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary w-100">Update Status</button>
                    </form>

                    <h4 class="card-title mt-5">All Health Statuses</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Blood Glucose (mg/dL)</th>
                                    <th>Cholesterol Level (mg/dL)</th>
                                    <th>Sleep (Hours)</th>
                                    <th>Water Intake (Liters)</th>
                                    <th>Current Weight (kg)</th>
                                    <th>Goal Weight (kg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($AllStatus as $status)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($status->created_at)->format('m/d/Y') }}</td>
                                        <td>{{ $status->blood_glucose }}</td>
                                        <td>{{ $status->cholesterol_level }}</td>
                                        <td>{{ $status->sleep }}</td>
                                        <td>{{ $status->water_intake }}</td>
                                        <td>{{ $status->current_weight }}</td>
                                        <td>{{ $status->goal_weight }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();

    document.addEventListener('DOMContentLoaded', function () {
        const heightInput = document.getElementById('height');
        const weightInput = document.getElementById('current_weight');
        const bmiField = document.getElementById('bmi');
        const bmiAlert = document.getElementById('bmi-alert');

        function calculateBMI() {
            const height = parseFloat(heightInput.value) / 100; // Convert to meters
            const weight = parseFloat(weightInput.value);

            if (height > 0 && weight > 0) {
                const bmi = (weight / (height * height)).toFixed(1); // BMI formula
                bmiField.value = bmi;

                // Determine BMI category
                let message = '';
                let alertClass = '';
                if (bmi < 18.5) {
                    message = 'Underweight';
                    alertClass = 'bmi-alert warning';
                } else if (bmi >= 18.5 && bmi < 24.9) {
                    message = 'Normal weight';
                    alertClass = 'bmi-alert success';
                } else if (bmi >= 25 && bmi < 29.9) {
                    message = 'Overweight';
                    alertClass = 'bmi-alert warning';
                } else {
                    message = 'Obesity';
                    alertClass = 'bmi-alert danger';
                }

                bmiAlert.textContent = '';
                bmiAlert.textContent = message;
                bmiAlert.className = alertClass;
            } else {
                bmiField.value = 'N/A';
                bmiAlert.textContent = '';
                bmiAlert.className = 'bmi-alert neutral';
            }
        }

        // Attach event listeners
        heightInput.addEventListener('input', calculateBMI);
        weightInput.addEventListener('input', calculateBMI);

        // Initial calculation (if data exists)
        calculateBMI();
    });
</script>
@endsection
