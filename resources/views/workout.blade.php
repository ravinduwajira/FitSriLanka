@extends('dashboard')
@section('User')

<title>Workout Page</title>
<style>
    .workout-section {
        margin-bottom: 2rem;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .workout-timer-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
    }

    .workout-schedule,
    .workout-benefits,
    .workout-duration,
    .calories-burn,
    .additional-info {
        white-space: pre-wrap;
        font-family: Arial, sans-serif;
        line-height: 1.5;
    }

    h3, h4 {
        font-weight: bold;
    }

    .img-fluid {
        border-radius: 5px;
    }

    .btn {
        margin-right: 0.5rem;
    }
</style>

<br>
<br>
<div class="container mt-5">
    @if ($workoutPlan)
    <!-- Heading -->
    <div class="text-center mb-4">
        <h1 class="display-5">Enrolled Workout Plan</h1>
        <h3>Assigned Fitness Professional: <span class="text-primary">{{ $professionalData->professional_name }}</span></h3>
    </div>

    <!-- Workout Sections -->
    <div class="row">
        <!-- Workout Schedule & Timer -->
        <div class="col-md-6 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout Schedule</h4>
                    <div class="workout-schedule">
                        {!! nl2br(e($workoutPlan->workout_schedule)) !!}
                    </div>
                    <div class="workout-timer-section">
                        <div>
                            <button class="btn btn-success" id="start-workout">Start Workout</button>
                            <button class="btn btn-danger" id="end-workout">End Workout</button>
                            <button class="btn btn-warning" id="reset-timer">Reset</button>
                        </div>
                        <h3><span id="workout-timer">00:00:00</span></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workout Benefits -->
        <div class="col-md-6 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout Benefits</h4>
                    <div class="workout-benefits">
                        {!! nl2br(e($workoutPlan->workout_benefits)) !!}
                    </div>
                </div>
            </div>
             <!-- Workout Image -->
        <div class="col-md-12 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout Image</h4>
                    @if($workoutPlan->workout_image)
                    <div class="mb-3">
                        <img src="{{ asset('assets/upload/workout_images/' . $workoutPlan->workout_image) }}" class="img-fluid" alt="Workout Image">
                    </div>
                    @else
                    <p>No workout image available.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- Calories Burned -->
        <div class="col-md-12 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Calories Burn</h4>
                    <div class="calories-burn">
                       <h4> {!! nl2br(e($workoutPlan->calorie_burn)) !!} kCal </h4>
                    </div>
                </div>
            </div>
        </div>
        </div>

       

        <!-- Workout Video -->
        <div class="col-md-6 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout Video</h4>
                    @if($workoutPlan->workout_video)
                    <div class="mb-3">
                        <video width="100%" controls>
                            <source src="{{ asset('assets/upload/workout_videos/' . $workoutPlan->workout_video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    @else
                    <p>No workout video available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Workout Duration Guide -->
        <div class="col-md-6 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout Duration Guide</h4>
                    <div class="workout-duration">
                        {!! nl2br(e($workoutPlan->workout_duration)) !!}
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Additional Information -->
        <div class="col-md-12 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Additional Information</h4>
                    <div class="additional-info">
                        {!! nl2br(e($workoutPlan->additional_info)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Workout History -->
        <div class="col-md-12 workout-section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Workout History</h4>
                    @if($workoutHistory->isNotEmpty())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Workout Schedule</th>
                                <th>Date & Time</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workoutHistory as $history)
                            <tr>
                                <td>{{ Str::limit($history->workout_schedule, 50) }}</td>
                                <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $history->duration }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No workout history available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Hidden form inputs -->
        <form method="POST" action="{{ route('store.workout.history') }}" id="workout-form">
            @csrf
            <input type="hidden" name="workout_plan_id" value="{{ $workoutPlan->id }}">
            <input type="hidden" id="start_time" name="start_time">
            <input type="hidden" id="end_time" name="end_time">
            <input type="hidden" id="workout_duration_displayed" name="workout_duration_displayed">
            <input type="hidden" id="workout_schedule" name="workout_schedule" value="{{ $workoutPlan->workout_schedule }}">
        </form>
    </div>
    @else
    <div class="alert alert-warning text-center">No workout plan assigned yet.</div>
    @endif
</div>


<script>
   let timer;
let totalSeconds = 0;
let isRunning = false;

// Function to start the timer
function startTimer() {
    if (!isRunning) {
        const startTime = new Date();
        localStorage.setItem('startTime', startTime.toISOString());
        isRunning = true;
        localStorage.setItem('isRunning', 'true');
        timer = setInterval(updateTimer, 1000);
    }
}

// Function to stop the timer and submit the form
function stopTimer() {
    clearInterval(timer);
    isRunning = false;
    localStorage.removeItem('isRunning');
    localStorage.removeItem('startTime');
    localStorage.removeItem('totalSeconds');

    const endTime = new Date();
    document.getElementById('end_time').value = endTime.toISOString();
    document.getElementById('workout_duration_displayed').value = formatTime(totalSeconds);
    document.getElementById('workout-form').submit();
}

// Function to reset the timer
function resetTimer() {
    clearInterval(timer);
    isRunning = false;
    totalSeconds = 0;
    document.getElementById('workout-timer').textContent = "00:00:00";
    localStorage.removeItem('isRunning');
    localStorage.removeItem('startTime');
    localStorage.removeItem('totalSeconds');
}

// Function to update the timer display
function updateTimer() {
    totalSeconds++;
    document.getElementById('workout-timer').textContent = formatTime(totalSeconds);
    localStorage.setItem('totalSeconds', totalSeconds);
}

// Helper function to format time
function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;

    return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
}

// Restore timer state on page load
document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('isRunning') === 'true') {
        const startTime = new Date(localStorage.getItem('startTime'));
        const now = new Date();
        totalSeconds = Math.floor((now - startTime) / 1000) + (parseInt(localStorage.getItem('totalSeconds'), 10) || 0);
        isRunning = true;
        timer = setInterval(updateTimer, 1000);
    } else {
        totalSeconds = parseInt(localStorage.getItem('totalSeconds'), 10) || 0;
        document.getElementById('workout-timer').textContent = formatTime(totalSeconds);
    }
});

// Button event listeners
document.getElementById('start-workout').addEventListener('click', startTimer);
document.getElementById('end-workout').addEventListener('click', stopTimer);
document.getElementById('reset-timer').addEventListener('click', resetTimer);

</script>

@endsection
