@extends('dashboard')

@section('User')
<br>
<br>
<br>
<br>

<div class="container">
    <h3 class="text-center mb-5 display-4 fw-bold">Your Personalized Health Report 📊</h3>
    <h4>This report provides insights into your health progress over time. Track key health metrics like weight, blood glucose, cholesterol, sleep hours, and water intake. Use these charts to monitor trends and make informed decisions about your wellness.</h4>
<br>
    @php
    if ($lastHealthStatus) {
        $weights = $lastHealthStatus->pluck('current_weight')->take(-12);
        $bloodGlucose = $lastHealthStatus->pluck('blood_glucose')->take(-12);
        $cholesterol = $lastHealthStatus->pluck('cholesterol_level')->take(-12);
        $sleepHours = $lastHealthStatus->pluck('sleep')->take(-12);
        $waterIntake = $lastHealthStatus->pluck('water_intake')->take(-12);
        $dates = $lastHealthStatus->pluck('created_at')->take(-12)->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('m/d/Y');
        });
    } else {
        $weights = collect();
        $bloodGlucose = collect();
        $cholesterol = collect();
        $sleepHours = collect();
        $waterIntake = collect();
        $dates = collect();
    }
    @endphp

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

    <div class="row mb-4">
        <!-- Weight Tracker -->
        <div class="col-lg-6 col-xl-6 mb-4">
            <div class="card shadow-lg border-primary">
                <div class="card-body">
                    <h6 class="card-title text-primary">Weight Tracker</h6>
                    <p class="text-muted">Track your weight changes over the past 12 weeks.</p>
                    <div id="WeightChart"></div>
                </div>
            </div>
        </div>

        <!-- Blood Glucose Levels -->
        <div class="col-lg-6 col-xl-6 mb-4">
            <div class="card shadow-lg border-success">
                <div class="card-body">
                    <h6 class="card-title text-success">Blood Glucose Levels</h6>
                    <p class="text-muted">Track your blood glucose levels and manage your diet accordingly.</p>
                    <div id="BloodGlucoseChart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Cholesterol Levels -->
        <div class="col-lg-6 col-xl-6 mb-4">
            <div class="card shadow-lg border-warning">
                <div class="card-body">
                    <h6 class="card-title text-warning">Cholesterol Levels</h6>
                    <p class="text-muted">Monitor your cholesterol levels to reduce the risk of heart disease.</p>
                    <div id="CholesterolChart"></div>
                </div>
            </div>
        </div>

        <!-- Sleep Hours -->
        <div class="col-lg-6 col-xl-6 mb-4">
            <div class="card shadow-lg border-info">
                <div class="card-body">
                    <h6 class="card-title text-info">Sleep Hours</h6>
                    <p class="text-muted">Adequate sleep is crucial for mental and physical recovery.</p>
                    <div id="SleepChart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Water Intake -->
        <div class="col-lg-12 col-xl-12 mb-4">
            <div class="card shadow-lg border-primary">
                <div class="card-body">
                    <h6 class="card-title text-primary">Water Intake</h6>
                    <p class="text-muted">Stay hydrated to support bodily functions and enhance energy levels.</p>
                    <div id="WaterIntakeChart"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        // Weight Chart
        if ($('#WeightChart').length) {
            var weights = {!! json_encode($weights->toArray()) !!};
            var dates = {!! json_encode($dates->toArray()) !!};
            var options = {
                chart: { type: 'line', height: 400, foreColor: '#000', background: '#fff', toolbar: { show: false } },
                series: [{ name: 'Weight', data: weights }],
                xaxis: { type: 'category', categories: dates },
                yaxis: { title: { text: 'Weight (kg)', style: { size: 10, color: '#999' } } },
                stroke: { curve: 'smooth', colors: ['#007bff'] }, // Line color same as card border (primary)
                grid: { borderColor: '#ccc' },
                tooltip: { enabled: true, shared: true }
            };
            var chart = new ApexCharts(document.querySelector("#WeightChart"), options);
            chart.render();
        }

        // Blood Glucose Chart
        if ($('#BloodGlucoseChart').length) {
            var bloodGlucose = {!! json_encode($bloodGlucose->toArray()) !!};
            var options = {
                chart: { type: 'line', height: 400, foreColor: '#000', background: '#fff', toolbar: { show: false } },
                series: [{ name: 'Blood Glucose', data: bloodGlucose }],
                xaxis: { type: 'category', categories: dates },
                yaxis: { title: { text: 'Blood Glucose (mg/dL)', style: { size: 10, color: '#999' } } },
                stroke: { curve: 'smooth', colors: ['#28a745'] }, // Line color same as card border (success)
                grid: { borderColor: '#ccc' },
                tooltip: { enabled: true, shared: true }
            };
            var chart = new ApexCharts(document.querySelector("#BloodGlucoseChart"), options);
            chart.render();
        }

        // Cholesterol Chart
        if ($('#CholesterolChart').length) {
            var cholesterol = {!! json_encode($cholesterol->toArray()) !!};
            var options = {
                chart: { type: 'line', height: 400, foreColor: '#000', background: '#fff', toolbar: { show: false } },
                series: [{ name: 'Cholesterol', data: cholesterol }],
                xaxis: { type: 'category', categories: dates },
                yaxis: { title: { text: 'Cholesterol (mg/dL)', style: { size: 10, color: '#999' } } },
                stroke: { curve: 'smooth', colors: ['#ffc107'] }, // Line color same as card border (warning)
                grid: { borderColor: '#ccc' },
                tooltip: { enabled: true, shared: true }
            };
            var chart = new ApexCharts(document.querySelector("#CholesterolChart"), options);
            chart.render();
        }

        // Sleep Hours Chart
        if ($('#SleepChart').length) {
            var sleepHours = {!! json_encode($sleepHours->toArray()) !!};
            var options = {
                chart: { type: 'line', height: 400, foreColor: '#000', background: '#fff', toolbar: { show: false } },
                series: [{ name: 'Sleep Hours', data: sleepHours }],
                xaxis: { type: 'category', categories: dates },
                yaxis: { title: { text: 'Sleep Hours', style: { size: 10, color: '#999' } } },
                stroke: { curve: 'smooth', colors: ['#17a2b8'] }, // Line color same as card border (info)
                grid: { borderColor: '#ccc' },
                tooltip: { enabled: true, shared: true }
            };
            var chart = new ApexCharts(document.querySelector("#SleepChart"), options);
            chart.render();
        }

        // Water Intake Chart
        if ($('#WaterIntakeChart').length) {
            var waterIntake = {!! json_encode($waterIntake->toArray()) !!};
            var options = {
                chart: { type: 'line', height: 400, foreColor: '#000', background: '#fff', toolbar: { show: false } },
                series: [{ name: 'Water Intake', data: waterIntake }],
                xaxis: { type: 'category', categories: dates },
                yaxis: { title: { text: 'Water Intake (L)', style: { size: 10, color: '#999' } } },
                stroke: { curve: 'smooth', colors: ['#007bff'] }, // Line color same as card border (primary)
                grid: { borderColor: '#ccc' },
                tooltip: { enabled: true, shared: true }
            };
            var chart = new ApexCharts(document.querySelector("#WaterIntakeChart"), options);
            chart.render();
        }
    });
</script>
@endsection
