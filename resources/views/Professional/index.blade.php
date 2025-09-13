@extends('Professional.Professional_dashboard') 
@section('Professional')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Custom CSS for card styles -->
<style>
    .card {
        border: 2px solid black; /* Black border */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
        transition: transform 0.3s, box-shadow 0.3s; /* Smooth hover transition */
    }

    .card:hover {
        transform: scale(1.01); /* Slightly enlarge on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Darker shadow on hover */
    }

    .card h3 {
        font-size: 2rem; /* Bigger font size for numbers */
        font-weight: bold; /* Make the text bold */
    }

    .card h4 {
        font-size: 1.5rem; /* Increase title font size */
        font-weight: bold; /* Bold titles */
    }

    .icon {
        margin-bottom: 15px;
    }

    .motivational-text {
        font-size: 1.2rem;
        color: #7f8c8d;
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Hi {{ $profileData->name }} 👋, Welcome to FitSriLanka Professional Dashboard</h4>
        </div>
    </div>

    <div class="row">
        <!-- Total Revenue -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #1abc9c; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="card-title">Total Revenue</h4>
                    <h3 class="font-weight-bold">Rs.{{ $totalRevenue }}</h3>
                </div>
            </div>
        </div>

        <!-- This Month's Revenue -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #3498db; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h4 class="card-title">This Month's Revenue</h4>
                    <h3 class="font-weight-bold">Rs.{{ $currentMonthRevenue }}</h3>
                </div>
            </div>
        </div>

        <!-- Active Clients -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #2ecc71; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="card-title">Active Clients</h4>
                    <h3 class="font-weight-bold">{{ $enrollmentCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Active Fitness Centers -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #e74c3c; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-dumbbell fa-2x"></i>
                    </div>
                    <h4 class="card-title">Active Fitness Centers</h4>
                    <h3 class="font-weight-bold">{{ $fitnessCenters }}</h3>
                </div>
            </div>
        </div>

        <!-- Issued Diet Plans -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #f39c12; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-utensils fa-2x"></i>
                    </div>
                    <h4 class="card-title">Issued Diet Plans</h4>
                    <h3 class="font-weight-bold">{{ $mealscount }}</h3>
                </div>
            </div>
        </div>

        <!-- Issued Workouts -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background-color: #8e44ad; color: white;">
                <div class="card-body text-center">
                    <div class="icon mb-2">
                        <i class="fas fa-running fa-2x"></i>
                    </div>
                    <h4 class="card-title">Issued Workouts</h4>
                    <h3 class="font-weight-bold">{{ $workoutPlanCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- New Section: Certifications, Experience, Specializations, Bio, etc. -->
    <div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Update Your Professional Info</h4>

                <!-- Display Form for updating professional info -->
                <form action="{{ route('Professional.info.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <!-- Certifications -->
                        <label for="certifications" class="form-label">Certifications</label>
                        <input type="text" class="form-control" name="certifications" id="certifications" value="{{ $professionalInfo->certifications ?? '' }}" placeholder="Enter your certifications">
                    </div>

                    <div class="mb-3">
                        <!-- Years of Experience -->
                        <label for="experience" class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" name="experience" id="experience" value="{{ $professionalInfo->experience ?? '' }}" placeholder="Enter your years of experience">
                    </div>

                    <div class="mb-3">
                        <!-- Specializations -->
                        <label for="specializations" class="form-label">Specializations</label>
                        <input type="text" class="form-control" name="specializations" id="specializations" value="{{ $professionalInfo->specializations ?? '' }}" placeholder="Enter your specializations">
                    </div>

                    <div class="mb-3">
                        <!-- Professional Bio -->
                        <label for="bio" class="form-label">Professional Bio</label>
                        <textarea class="form-control" name="bio" id="bio" rows="4" placeholder="Write a short bio about yourself">{{ $professionalInfo->bio ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <!-- Programs Offered -->
                        <label for="programs" class="form-label">Programs Offered</label>
                        <input type="text" class="form-control" name="programs" id="programs" value="{{ $professionalInfo->programs ?? '' }}" placeholder="List the programs you offer">
                    </div>

                    <div class="mb-3">
                        <!-- Monthly Fee -->
                        <label for="monthly_fee" class="form-label">Monthly Fee (in your currency)</label>
                        <input type="number" class="form-control" name="monthly_fee" id="monthly_fee" value="{{ $professionalInfo->monthly_fee ?? '' }}" placeholder="Enter your monthly fee">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Update Info</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Motivational Text -->
    <div class="motivational-text">
        "Success isn't always about greatness. It's about consistency. 💪✨ Keep up the great work! 🎉🙌"
    </div>
</div>

@endsection
