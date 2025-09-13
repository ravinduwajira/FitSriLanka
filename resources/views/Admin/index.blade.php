@extends('Admin.admin_dashboard')
@section('Admin')
<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.revenue-card {
    background-color: #1abc9c;
    color: white;
}

.profit-card {
    background-color: #3498db;
    color: white;
}

.clients-card {
    background-color: #2ecc71;
    color: white;
}

.fitness-card {
    background-color: #e74c3c;
    color: white;
}

.professionals-card {
    background-color: #8e44ad;
    color: white;
}

.workoutplans-card {
    background-color: #f39c12;
    color: white;
}

.dietplans-card {
    background-color: #d35400;
    color: white;
}

.btn-group .btn {
    border-radius: 50px;
}

  </style>
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Hi {{ $profileData->name }} 👋, Welcome to FitSriLanka Admin Dashboard</h4>
        </div>

        <div class="row">
            <!-- Total Revenue -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card revenue-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <h4 class="card-title">Total Revenue</h4>
                        <h3 class="font-weight-bold">Rs.{{ $allTimeRevenue }}</h3>
                    </div>
                </div>
            </div>

            <!-- This Month's Revenue -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card revenue-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h4 class="card-title">This Month's Revenue</h4>
                        <h3 class="font-weight-bold">Rs.{{ $thisMonthRevenue }}</h3>
                    </div>
                </div>
            </div>

            <!-- This Month's Profit -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card profit-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-coins fa-2x"></i>
                        </div>
                        <h4 class="card-title">This Month's Profit</h4>
                        <h3 class="font-weight-bold">Rs.{{ $thisMonthProfit }}</h3>
                    </div>
                </div>
            </div>

            <!-- All-Time Profit -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card profit-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-coins fa-2x"></i>
                        </div>
                        <h4 class="card-title">All-Time Profit</h4>
                        <h3 class="font-weight-bold">Rs.{{ $allTimeProfit }}</h3>
                    </div>
                </div>
            </div>

            <!-- Active Clients -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card clients-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="card-title">Active Clients</h4>
                        <h3 class="font-weight-bold">{{ $UserCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Active Fitness Centers -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card fitness-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-dumbbell fa-2x"></i>
                        </div>
                        <h4 class="card-title">Active Fitness Centers</h4>
                        <h3 class="font-weight-bold">{{ $fitnessCenters }}</h3>
                    </div>
                </div>
            </div>

            <!-- Active Professionals -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card professionals-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-running fa-2x"></i>
                        </div>
                        <h4 class="card-title">Active Professionals</h4>
                        <h3 class="font-weight-bold">{{ $ProfessionalCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Workout Plans -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card workoutplans-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-dumbbell fa-2x"></i>
                        </div>
                        <h4 class="card-title">Total Workout Plans</h4>
                        <h3 class="font-weight-bold">{{ $WorkoutPlanCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Diet Plans -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card dietplans-card">
                    <div class="card-body text-center">
                        <div class="icon mb-2">
                            <i class="fas fa-utensils fa-2x"></i>
                        </div>
                        <h4 class="card-title">Total Diet Plans</h4>
                        <h3 class="font-weight-bold">{{ $MealPlanCount }}</h3>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
</div>

       
</div>

@endsection
