@extends('dashboard')
@section('User')
<div class="page-content">
<!-- Add jQuery CDN before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

        <div>
            <h4 class="mb-3 mb-md-0">Hi {{ $profileData->name }} 👋, Welcome to FitSriLanka User Dashboard</h4>
            
        </div>
    </div>

    <div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <!-- Blood Glucose -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-nowrap">Blood Glucose</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 text-nowrap">{{ $lastHealthStatus->blood_glucose ?? 'N/A' }} mg/dl</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-muted text-nowrap">After fasting</p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7 d-flex justify-content-center align-items-center">
                <img src="\upload\admin_images\blood-icon.png" alt="Blood Glucose Icon" class="img-fluid" style="max-width: 100px; max-height: 100px;" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Cholesterol Level -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-nowrap">Cholesterol Level</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 text-nowrap">{{ $lastHealthStatus ? $lastHealthStatus->cholesterol_level : 'N/A' }} mg/dl</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-muted text-nowrap">Last check</p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <img src="\upload\admin_images\cholesterol-icon.png" alt="Cholesterol Icon" class="img-fluid" style="max-width: 100px; max-height: 100px;"/>
              </div>
            </div>
          </div>
        </div>
      </div>

     <!-- Calories Intake, Burn, and Icon -->
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-baseline">
                <h6 class="card-title mb-0 text-nowrap">Calories</h6>
            </div>
            <div class="row align-items-left">
                <!-- Calorie Intake Section -->
                <div class="col-3" style="text-align: left;">
                    <h3 class="mb-2 text-nowrap">{{ $CalorieIntake }} <br> kCal</h3>
                    <p class="text-muted text-nowrap">Today's Intake</p>
                </div>

                <!-- Vertical Line Divider -->
                <div class="col-1">
                    <div style="border-left: 1px solid #ccc; height: 60px;"></div>
                </div>

                <!-- Calorie Burn Section -->
                <div class="col-3" style="text-align: left;">
                    <h3 class="mb-2 text-nowrap">{{ $CalorieBurn }}<br> kCal</h3>
                    <p class="text-muted text-nowrap">Today's Burn</p>
                </div>

                <!-- Icon Section -->
                <div class="col-3" style="text-align: left;">
                    <img src="/upload/admin_images/calories-icon.png" alt="Calories Icon" class="img-fluid"  />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <!-- Sleep -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-nowrap">Sleep</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 text-nowrap">{{ $lastHealthStatus ? $lastHealthStatus->sleep : 'N/A' }} hrs</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-muted text-nowrap">Last night</p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <img src="\upload\admin_images\sleep-icon.png" alt="Sleep Icon" class="img-fluid" style="max-width: 100px; max-height: 100px;"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Workout -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-nowrap">Workout</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 text-nowrap">{{ $workoutDuration }}</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-muted text-nowrap">Today's activity</p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <img src="\upload\admin_images\workout-icon.png" alt="Workout Icon" class="img-fluid" style="max-width: 100px; max-height: 100px;"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Water Intake -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0 text-nowrap">Water Intake</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 text-nowrap">{{ $lastHealthStatus ? $lastHealthStatus->water_intake : 'N/A' }} Ltr</h3>
                <div class="d-flex align-items-baseline">
                  <p class="text-muted text-nowrap">Today's intake</p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <img src="\upload\admin_images\water-intake-icon.png" alt="Water Intake Icon" class="img-fluid" style="max-width: 100px; max-height: 100px;"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->



    <div class="row">
      <!-- Today Diet Plan Card -->
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Today Diet Plan</h6>
                
            </div>

            @if($mealToShow)
                <h5 class="mt-3">{{ ucfirst($mealToShow->meal_time) }}</h5>
                <div class="row">
                    <div class="col-6">
                        <!-- Display the meal image -->
                        <img src="{{ url(''. $mealToShow->photo) }}" alt="Diet Plan Image" class="img-fluid rounded">
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <!-- Display ingredients dynamically -->
                            @foreach(explode(',', $mealToShow->ingredients) as $ingredient)
                                <li><i class="fas fa-utensils"></i> {{ $ingredient }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-2">
                            <strong>Nutritional Values:</strong>
                            <p>
                                <span class="text-protein"> {{ $mealToShow->nutritional_value }}g</span><br>
                                <span>Calories: {{ $mealToShow->calorie_count }} kcal</span>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <p>No meal plan found for today at this time.</p>
            @endif
        </div>
    </div>



      </div>

     <!-- Fasting Tracker Card -->
     <div class="col-md-6 grid-margin stretch-card">
  <div class="card shadow-sm border-0 rounded">
    <div class="card-body p-4">
      <!-- Current Fast Name at the Top, Bigger Text -->
      <h2 class="card-title text-primary font-weight-bold mb-4">Current Fast: <span>{{ $currentFast }}</span></h2>

      <!-- Time Left and Percentage in One Row -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Time Left -->
        <div class="d-flex flex-column align-items-start">
          <h6 class="text-muted mb-2">Time Left</h6>
          <h2 id="fasting-timer-left" class="timer-display text-primary fw-bold" style="font-size: 2rem;">--:--:--</h2>
        </div>
        <!-- Progress Percentage -->
        <div class="d-flex flex-column align-items-end">
          <h6 class="text-muted mb-2">Progress</h6>
          <h2 id="progress-percentage" class="fw-bold" style="color: black; font-size: 2rem;">{{ $progress }}%</h2>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="progress mb-4" style="height: 45px; border-radius: 10px; overflow: hidden;">
        <div class="progress-bar progress-bar-striped progress-bar-animated"
             role="progressbar"
             id="fasting-progress-bar"
             style="width: {{ $progress }}%; background-color: #3399ff;"
             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
        </div>
      </div>

      <!-- End Fast Button Full Width -->
      <form action="{{ route('fasting.end') }}" method="POST" onsubmit="updateElapsedTime()" class="mt-4">
        @csrf
        <input type="hidden" name="elapsed_time" id="elapsed-time-input">
        <button type="submit" class="btn btn-danger btn-lg w-100"
                {{ !$isFasting ? 'disabled' : '' }}>
          End Fast
        </button>
      </form>
    </div>
  </div>
</div>
    </div>


    @php
// Check if $lastHealthStatus is not null before trying to pluck values
if ($lastHealthStatus) {
    $weights = $lastHealthStatus->pluck('current_weight')->take(-12);
    $dates = $lastHealthStatus->pluck('created_at')->take(-12)->map(function($date) {
        return \Carbon\Carbon::parse($date)->format('m/d/Y');
    });
} else {
    // Handle case when there are no health statuses
    $weights = collect(); // Or set a default value
    $dates = collect(); // Or set a default value
}
@endphp


<div class="row">
  <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Weight Tracker</h6>
        </div>
        <p class="text-muted">Monitor your daily progress. With each Update, your weight is reflected in the graph.</p>
        <div id="WeightChart"></div>
      </div> 
    </div>
  </div>

          
          <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="card-title mb-0 text-primary">Target Weight Progress</h6>
        <i class="fas fa-weight text-muted"></i>
      </div>
      <div id="storageChart" class="mb-4"></div>
      <div class="row text-center">
        <div class="col-4">
          <div class="bg-danger p-2 rounded">
            <label class="d-block text-uppercase fw-bold text-white mb-1">Start Weight</label>
            <h5 class="fw-bold text-white" id="startWeight">
              {{ $lastHealthStatus ? $lastHealthStatus->start_weight : 'N/A' }} Kg
            </h5>
          </div>
        </div>
        <div class="col-4">
          <div class="bg-primary p-2 rounded">
            <label class="d-block text-uppercase fw-bold text-white mb-1">Current Weight</label>
            <h5 class="fw-bold text-white" id="currentWeight">
              {{ $lastHealthStatus ? $lastHealthStatus->current_weight : 'N/A' }} Kg
            </h5>
          </div>
        </div>
        <div class="col-4">
          <div class="bg-success p-2 rounded">
            <label class="d-block text-uppercase fw-bold text-white mb-1">Goal Weight</label>
            <h5 class="fw-bold text-white" id="goalWeight">
              {{ $lastHealthStatus ? $lastHealthStatus->goal_weight : 'N/A' }} Kg
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

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
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const startWeight = parseFloat(document.getElementById('startWeight').innerText);
  const currentWeight = parseFloat(document.getElementById('currentWeight').innerText);
  const goalWeight = parseFloat(document.getElementById('goalWeight').innerText);

  if (!isNaN(startWeight) && !isNaN(currentWeight) && !isNaN(goalWeight)) {
    let percentageAchieved = ((startWeight - currentWeight) / (startWeight - goalWeight)) * 100;
    percentageAchieved = percentageAchieved.toFixed(2); // Round to two decimal places

    if ($('#storageChart').length) {
      var options = {
        chart: {
          height: 260,
          type: "radialBar"
        }, 
        series: [percentageAchieved],
        colors: ['#56ae57'], // Replace colors.primary with actual color code
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 15,
              size: "70%"
            },
            track: {
              show: true,
              background: '#f0f0f0', // Replace colors.light with actual color code
              strokeWidth: '150%', // Increase this value to make the ash-colored bar wider
              opacity: 1,
              margin: 5, 
            },
            dataLabels: {
              showOn: "always",
              name: {
                offsetY: -11,
                show: true,
                color: '#6c757d', // Replace colors.muted with actual color code
                fontSize: "13px"
              },
              value: {
                color: '#343a40', // Replace colors.bodyColor with actual color code
                fontSize: "30px",
                show: true
              }
            },
            stroke: {
              lineCap: "round",
              width: '150%' // Increase this value to make the green bar wider
            }
          }
        },
        fill: {
          opacity: 1
        },
        labels: ["Target Completion"]
      };
      
      var chart = new ApexCharts(document.querySelector("#storageChart"), options);
      chart.render();    
    }
  }
});

</script>

<script>
 $(document).ready(function() {
  if ($('#WeightChart').length) {
    var weights = {!! json_encode($weights->toArray()) !!};
    var dates = {!! json_encode($dates->toArray()) !!};

    var options = {
      chart: {
        type: 'bar',
        height: '318',
        parentHeightOffset: 0,
        foreColor: '#000',
        background: '#fff',
        toolbar: {
          show: false
        },
      },
      series: [{
        name: 'Weight',
        data: weights  
      }],
      xaxis: {
        type: 'category',  // Use 'category' instead of 'datetime'
        categories: dates,  // Dynamic dates data
        labels: {
          formatter: function(value, timestamp) {
            return value;  // Return the formatted date
          }
        },
        axisBorder: {
          color: '#ccc',
        },
        axisTicks: {
          color: '#ccc',
        },
      },
      yaxis: {
        title: {
          text: 'Weight (kg)',
          style: {
            size: 9,
            color: '#999'
          }
        },
      },
      grid: {
        borderColor: '#ccc',
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'top',
          }
        },
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: 'Arial, sans-serif',
        },
        offsetY: -27
      }
    }

    var apexBarChart = new ApexCharts(document.querySelector("#WeightChart"), options);
    apexBarChart.render();
  }
});
</script>

@endsection