@extends('dashboard')
@section('User')
<br>
     <br>
<div class="container mt-5">
    <!-- Header Section -->
     
    <div class="row text-center mb-4">      
        <h2 class="fw-bold text-primary">Fasting Tracker 🥗</h2>
    </div>

<!-- Fasting Options Section -->
<div class="row text-center">
    @foreach($fastingOptions as $index => $option)
        <div class="col-md-4 mb-4">
            <div class="card shadow fasting-card border-0 rounded-lg">
                <img src="{{ $option['image_url'] }}" class="card-img-top fasting-img" alt="{{ $option['name'] }}">
                <div class="card-body">
                   
                    <h4 class="card-title text-dark fw-bold" style="font-size: 1.2rem;">{{ $option['name'] }}</h4>
                    <p class="card-text">{{ $option['description'] }}</p>
                    <form action="{{ url('/start-fasting/' . $index) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100" {{ $isFasting ? 'disabled' : '' }}>
                            Start Fasting
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

    <!-- Fasting Progress Section -->
    <div class="row text-center mt-5">
    <h4 class="fw-bold text-primary mb-4">Your Fasting Progress</h4>
    <div class="col-md-4">
        <div class="card shadow p-4 progress-card border-0 rounded-lg">
            <h5 class="text-dark mb-4">Fasting Timer</h5>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h6 class="text-success">Time Elapsed</h6>
                    <p id="fasting-timer" class="timer-display text-success fw-bold">--:--:--</p>
                </div>
                <div>
                    <h6 class="text-primary">Time Left</h6>
                    <p id="fasting-timer-left" class="timer-display text-primary fw-bold">--:--:--</p>
                </div>
            </div>
            <form action="{{ route('fasting.end') }}" method="POST" onsubmit="updateElapsedTime()">
                @csrf
                <input type="hidden" name="elapsed_time" id="elapsed-time-input">
                <button type="submit" class="btn btn-outline-danger w-100" {{ !$isFasting ? 'disabled' : '' }}>
                    End Fast
                </button>
            </form>
        </div>




    <!-- Nutritional Tips Section -->
<div class="row text-center mt-5">
    <h4 class="fw-bold text-primary">Nutritional Tips During Your Fast</h4>
    <div class="col-md-12">
        <div class="card shadow p-2 tips-card border-0 rounded-lg bg-light">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="droplet" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Stay hydrated with water, herbal teas, and electrolyte drinks.</span>
                </li>
                <hr style="margin: 0.5rem 0;">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="bar-chart-2" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Include fiber-rich foods in your pre-fast meal to stay full longer.</span>
                </li>
                <hr style="margin: 0.5rem 0;">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="x-circle" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Avoid processed foods and sugar during your eating windows.</span>
                </li>
            </ul>
        </div>
    </div>
</div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-4 progress-card border-0 rounded-lg">
                <h5 class="text-dark mb-3">Current Fast: {{ $currentFast }}</h5>
                <div class="progress mb-3" style="height: 35px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                         role="progressbar" 
                         id="fasting-progress-bar"
                         style="width: {{ $progress }}%;"
                         aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        <strong>{{ $progress }}%</strong>
                    </div>
                </div>
            </div>
          <!-- Fasting Tips Section -->
<div class="row text-center mt-5">
    <h4 class="fw-bold text-primary">Fasting Tips</h4>
    <div class="col-md-12">
        <div class="card shadow p-2 tips-card border-0 rounded-lg bg-light">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="clock" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Start slow if you're new to fasting—try 12-14 hours first.</span>
                </li>
                <hr style="margin: 0.5rem 0;">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="activity" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Mentally prepare and have a plan for breaking your fast.</span>
                </li>
                <hr style="margin: 0.5rem 0;">
                <li class="d-flex align-items-center mb-2" style="margin-bottom: 0.5rem;">
                    <i data-feather="heart" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                    <span class="text-dark fw-semibold" style="font-size: 0.9rem;">Listen to your body and stop if feeling unwell.</span>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>

       
<div class="col-md-4">
    <div class="card shadow p-3 phase-card border-0 rounded-lg bg-light">
        <h5 class="text-dark mb-3">Fasting Phases</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item {{ $elapsedTime >= 0 && $elapsedTime < 14400 ? 'active-phase' : ($elapsedTime >= 14400 ? 'completed-phase' : '') }}">
                <i data-feather="activity" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                <strong>Phase 1 (0-4 hours)</strong> 
                <br><span class="badge bg-success">Anabolic Phase</span>
                <p>Your body is building muscle and converting nutrients into energy.</p>
                <small>{{ $elapsedTime >= 14400 ? 'Completed' : 'Current Phase' }}</small>
            </li>
            
            <li class="list-group-item {{ $elapsedTime >= 14400 && $elapsedTime < 57600 ? 'active-phase' : ($elapsedTime >= 57600 ? 'completed-phase' : '') }}">
                <i data-feather="trending-up" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                <strong>Phase 2 (4-16 hours)</strong> 
                <br><span class="badge bg-warning">Ketosis Begins</span>
                <p>Entering ketosis and starting to burn fat for energy.</p>
                <small>{{ $elapsedTime >= 57600 ? 'Completed' : 'Current Phase' }}</small>
            </li>
            
            <li class="list-group-item {{ $elapsedTime >= 57600 ? 'active-phase' : '' }}">
                <i data-feather="refresh-cw" class="text-primary me-3" style="font-size: 1.5rem;"></i>
                <strong>Phase 3 (16-24 hours)</strong> 
                <br> <span class="badge bg-primary">Autophagic Phase</span>
                <p>Autophagy promotes cellular repair and renewal.</p>
                <small>{{ $elapsedTime >= 57600 ? 'Current Phase' : 'Up Next' }}</small>
            </li>
        </ul>
    </div>
</div>
    </div>

   

   

   <!-- Fasting History Section -->
<div class="row text-center mt-5">
    <h4 class="fw-bold text-primary">Your Fasting History</h4>
    <div class="col-md-12">
        <table class="table table-hover table-striped shadow mt-3 bg-white rounded">
            <thead class="thead-dark">
                <tr>
                    <th>Fasting Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fastingHistory as $history)
                    <tr>
                        <td>{{ $history->fasting_plan }}</td>
                        <td>{{ $history->start_time }}</td>
                        <td>{{ $history->end_time }}</td>
                        <td>{{ $history->duration }} hours</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
let isFasting = {{ $isFasting ? 'true' : 'false' }};
let fastingTimer;
let seconds = {{ $elapsedTime ?? 0 }};
if (isFasting) startFasting();
function startFasting() {
    fastingTimer = setInterval(() => { seconds++; updateTimerDisplay(); }, 1000);
}
function updateTimerDisplay() {
    let hrs = Math.floor(seconds / 3600);
    let mins = Math.floor((seconds % 3600) / 60);
    let secs = seconds % 60;
    document.getElementById('fasting-timer').textContent = `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

let fastingTimer2;
let secondsleft = {{ $leftTime ?? 0 }};
if (isFasting) startFastingleft();
function startFastingleft() {
    fastingTimer2 = setInterval(() => {
        if (secondsleft > 0) {
            secondsleft--;
            updateTimerDisplayleft();
        } else clearInterval(fastingTimer2);
    }, 1000);
}
function updateTimerDisplayleft() {
    let hrs = Math.floor(secondsleft / 3600);
    let mins = Math.floor((secondsleft % 3600) / 60);
    let secs = secondsleft % 60;
    document.getElementById('fasting-timer-left').textContent = `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}
</script>

<script>
    function updateElapsedTime() {
        const elapsedTime = document.getElementById('fasting-timer').textContent;
        document.getElementById('elapsed-time-input').value = elapsedTime;
    }
</script>
<!-- Styles -->
<style>
    .fasting-img {
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }
    .timer-display {
        font-size: 2rem;
        font-weight: 600;
    }
    .progress-card {
        background-color: #f0f8ff;
    }
    .progress-bar {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .active-phase {
        background-color: #d1ecf1;
    }
    .completed-phase {
        background-color: #e2e3e5;
       
    }
    .tips-card {
        bbackground-color: #f8f9fa; /* Light grey background */
        border-radius: 20px; /* Smooth rounded corners */
        transition: transform 0.2s ease-in-out;
    }
    .btn {
        font-size: 1rem;
    }

    .tips-card:hover {
        transform: scale(1.05); /* Slight zoom on hover */
    }

    .progress-card{
        border-radius: 20px; /* Smooth rounded corners */
        transition: transform 0.2s ease-in-out;
    }
    .progress-card:hover {
        transform: scale(1.05); /* Slight zoom on hover */
    }
    .phase-card{
        border-radius: 20px; /* Smooth rounded corners */
        transition: transform 0.2s ease-in-out;
    }
    .phase-card:hover {
        transform: scale(1.05); /* Slight zoom on hover */
    }
    i.fas {
        color: #0d6efd; /* Icon color matching primary theme */
    }

    .fw-semibold {
        font-weight: 600; /* Semi-bold font */
    }

    .me-3 {
        margin-right: 1rem; /* Better spacing between icon and text */
    }
</style>

@endsection
