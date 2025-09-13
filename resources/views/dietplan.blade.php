@extends('dashboard')
@section('User')
<br><br>

<div class="container mt-5">
    <!-- Header Section -->
    <div class="row text-center mb-4">
        <h2 class="fw-bold">What are we cooking today?</h2>
        <p class="text-muted">{{ \Carbon\Carbon::now()->format('l, F jS Y h:i A') }}</p>
    </div>

    <!-- Meal Options Section -->
    <div class="row text-center">
        @foreach ($meals->where('date', \Carbon\Carbon::now()->toDateString()) as $meal)
            @if (in_array(strtolower($meal->meal_time), ['breakfast', 'lunch', 'dinner']))
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow-sm meal-card {{ strtolower($meal->meal_time) }}-card"
                         data-meal-time="{{ strtolower($meal->meal_time) }}"
                         data-nutritional-value="{{ $meal->nutritional_value }}"
                         data-ingredients="{{ $meal->ingredients }}"
                         data-recipe-name="{{ $meal->recipe_name }}"
                         data-recipe-instructions="{{ $meal->recipe_instructions }}"
                         data-calorie-count="{{ $meal->calorie_count }}">
                        <img src="{{ $meal->photo ? url($meal->photo) : asset('default-image.jpg') }}" class="img-fluid meal-img" alt="{{ $meal->meal_time }}">
                        <h4 class="mt-3 fw-bold">{{ $meal->recipe_name }}</h4>
                        <p class="text-muted">{{ count(explode(',', $meal->ingredients)) }} ingredients</p>
                        <p><strong>Meal Time:</strong> {{ ucfirst($meal->meal_time) }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Nutritional Information, Ingredients, and Recipe Instructions Section -->
<div class="row mt-5" id="meal-details" style="display: none;">
    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th class="fw-bold">Nutritional Information</th>
                <th class="fw-bold">Ingredients</th>
                <th class="fw-bold">Recipe Instructions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="nutritional-info-title"></td>
                <td id="ingredients-list">
                    <ul style="list-style-type: disc; padding-left: 20px;"></ul>
                </td>
                <td id="instructions-list"></td>
            </tr>
        </tbody>
    </table>
</div>


    <!-- Meal Plan for the Next 7 Days Section -->
    <div class="row mt-5">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold">Meal Plan for the Next 7 Days</h3>
        </div>
        @for ($i = 0; $i < 7; $i++)
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-light">
                        <h5 class="fw-bold mb-0">Day {{ $i+1 }} - {{ \Carbon\Carbon::now()->addDays($i)->format('l, F jS') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($meals->where('date', \Carbon\Carbon::now()->addDays($i)->toDateString()) as $meal)
                                <div class="col-md-4 mb-3">
                                    <div class="p-2">
                                        <h6 class="fw-bold">{{ ucfirst($meal->meal_time) }}</h6>
                                        <p><strong>Recipe:</strong> {{ $meal->recipe_name }}</p>
                                        <ul>
                                            @foreach (explode(',', $meal->ingredients) as $ingredient)
                                                <li>{{ $ingredient }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<!-- JavaScript to Handle Highlighting and Displaying Meal Details -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentHour = new Date().getHours();
        let cardClass = '';

        // Determine current meal time and highlight the corresponding card
        if (currentHour >= 2 && currentHour < 12) {
            cardClass = '.breakfast-card';
        } else if (currentHour >= 12 && currentHour < 18) {
            cardClass = '.lunch-card';
        } else if (currentHour >= 18 && currentHour < 23) {
            cardClass = '.dinner-card';
        }

        if (cardClass) {
            highlightCard(cardClass);
        }

        function highlightCard(cardClass) {
            const card = document.querySelector(cardClass);
            if (card) {
                card.classList.add('highlight-card');
                showMealDetails(card);
            }
        }

        function showMealDetails(card) {
            document.getElementById('meal-details').style.display = 'block';

            // Update Nutritional Values
            const nutritionalInfo = card.getAttribute('data-nutritional-value').split(',').map(value => value.trim());
            const nutritionalInfoList = document.getElementById('nutritional-info-title');
            const nutritionalValueContainer = document.createElement('ul');
            nutritionalInfo.forEach(value => {
                const li = document.createElement('li');
                li.textContent = value;
                nutritionalValueContainer.appendChild(li);
            });
            nutritionalInfoList.appendChild(nutritionalValueContainer);

            // Update Ingredients
            const ingredientsList = document.getElementById('ingredients-list');
            ingredientsList.innerHTML = '';
            card.getAttribute('data-ingredients').split(',').forEach(ingredient => {
                const li = document.createElement('li');
                li.textContent = ingredient.trim();
                ingredientsList.appendChild(li);
            });

            // Update Recipe Instructions
            const instructions = card.getAttribute('data-recipe-instructions').split(' ');
            const formattedInstructions = [];
            for (let i = 0; i < instructions.length; i += 5) {
                formattedInstructions.push(instructions.slice(i, i + 5).join(' '));
            }
            const instructionsList = document.getElementById('instructions-list');
            instructionsList.innerHTML = '';
            formattedInstructions.forEach(instruction => {
                const p = document.createElement('p');
                p.textContent = instruction.trim();
                instructionsList.appendChild(p);
            });
        }
    });
</script>

<!-- Add CSS for Improved Design -->
<style>
    .highlight-card {
        border: 3px solid #6CB4EE;
        background-color: #F0F8FF;
    }

    .meal-img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .meal-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }

    .meal-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 1.2rem;
    }

    .fw-bold {
        font-weight: 600;
    }

    p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
    }

    ul {
        padding-left: 20px;
        list-style-type: disc;
    }

    .table {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
    }

    td {
        padding: 15px;
        text-align: left;
    }
</style>

@endsection
