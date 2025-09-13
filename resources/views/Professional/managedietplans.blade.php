@extends('Professional.Professional_dashboard')
@section('Professional')
<br>
<div class="container my-5">
    <h2 class="text-center mb-5">Meal Plan for Clients <span class="text-primary">&#127869;</span></h2>

    <!-- Display Laravel Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Client selection form -->
    <form method="POST" action="{{ route('Professional.mealplan.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <!-- Select Client -->
        <div class="mb-4">
            <label for="client" class="form-label fw-bold">Select a Client</label>
            <select class="form-select" id="client" name="user_id" required>
                <option value="" disabled selected>-- Select a Client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a client.</div>
        </div>

        <!-- Accordion for 7-day meal plan -->
        <div class="accordion" id="mealPlanAccordion">
            @for ($day = 1; $day <= 7; $day++)
            <div class="accordion-item mb-3 shadow-sm">
                <h2 class="accordion-header" id="headingDay{{ $day }}">
                    <button class="accordion-button collapsed fw-bold day-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDay{{ $day }}" aria-expanded="false" aria-controls="collapseDay{{ $day }}">
                        Day {{ $day }}
                    </button>
                </h2>
                <div id="collapseDay{{ $day }}" class="accordion-collapse collapse" aria-labelledby="headingDay{{ $day }}" data-bs-parent="#mealPlanAccordion">
                    <div class="accordion-body">

                        <!-- Loop for 3 meals: Breakfast, Lunch, Dinner -->
                        @foreach (['Breakfast', 'Lunch', 'Dinner'] as $meal_time)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="mb-0">{{ $meal_time }}</h4>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#mealDetails{{ $day }}{{ strtolower($meal_time) }}" aria-expanded="false" aria-controls="mealDetails{{ $day }}{{ strtolower($meal_time) }}">
                                    Toggle Details <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div class="collapse" id="mealDetails{{ $day }}{{ strtolower($meal_time) }}">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <!-- Recipe Name -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Recipe Name</label>
                                            <input type="text" class="form-control" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][recipe_name]" placeholder="Enter recipe name" required>
                                            <div class="invalid-feedback">Recipe name is required.</div>
                                        </div>

                                        <!-- Photo -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Photo</label>
                                            <input type="file" class="form-control" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][photo]" accept="image/*" >

                                        </div>
                                    </div>

                                    <!-- Ingredients -->
                                    <div class="mb-3 mt-3">
                                        <label class="form-label fw-bold">Ingredients</label>
                                        <textarea class="form-control" rows="2" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][ingredients]" placeholder="List ingredients..." required></textarea>
                                        <div class="invalid-feedback">Ingredients are required.</div>
                                    </div>

                                    <!-- Nutritional Value -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nutritional Value</label>
                                        <textarea class="form-control" rows="2" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][nutritional_value]" placeholder="Enter nutritional details..." required></textarea>
                                        <div class="invalid-feedback">Nutritional value is required.</div>
                                    </div>

                                    <!-- Recipe Instructions -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Recipe Instructions</label>
                                        <textarea class="form-control" rows="3" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][recipe_instructions]" placeholder="Step-by-step instructions..." required></textarea>
                                        <div class="invalid-feedback">Recipe instructions are required.</div>
                                    </div>

                                    <!-- Calorie Count -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Calorie Count</label>
                                        <input type="number" class="form-control" name="meals[{{ $day }}][{{ strtolower($meal_time) }}][calorie_count]" min="0" placeholder="Enter calories" required>
                                        <div class="invalid-feedback">Calorie count is required.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endfor
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-success btn-lg px-5">Submit Meal Plan <i class="ms-2 bi bi-check-circle"></i></button>
        </div>
    </form>
</div>

<!-- Bootstrap Icons and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelector("form").addEventListener("submit", function (event) {
    let form = this;

    // Ensure accordions with invalid inputs are expanded
    let invalidFields = form.querySelectorAll(":invalid");
    if (invalidFields.length > 0) {
        event.preventDefault();
        event.stopPropagation();

        invalidFields.forEach(input => {
            let accordionBody = input.closest(".accordion-collapse");
            if (accordionBody) {
                accordionBody.classList.add("show");
            }
        });
    }

    form.classList.add("was-validated");
});
</script>

<!-- JavaScript to Calculate Day 1 Start Date Based on Latest End Date -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const clientSelect = document.getElementById("client");

    clientSelect.addEventListener("change", function () {
        let startDate = new Date();
        startDate.setDate(startDate.getDate() + 1); // Default: Tomorrow

        // Fetch latest end date for selected client (mocked example)
        let latestEndDate = new Date(localStorage.getItem(`client_${this.value}_latestEndDate`)); 

        if (!isNaN(latestEndDate) && latestEndDate > new Date()) {
            latestEndDate.setDate(latestEndDate.getDate() + 1);
            startDate = latestEndDate;
        }

        // Update Meal Plan Headers
        document.querySelectorAll(".day-header").forEach((button, index) => {
            let dayDate = new Date(startDate);
            dayDate.setDate(dayDate.getDate() + index);
            button.innerText = `Day ${index + 1} - ${dayDate.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' })}`;
        });
    });
});
</script>

@endsection
