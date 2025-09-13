<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fit Sri Lanka - User Information</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo logo-light d-block mb-2">Fit<span>SriLanka</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Fill in your information.</h5>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('userinfo.store') }}">
                                            @csrf

                                            <!-- Birthday -->
                                            <div class="mb-3">
                                                <label for="birthday" class="form-label">{{ __('Birthday') }}</label>
                                                <input type="date" class="form-control" id="birthday" name="birthday" :value="old('birthday')" required autocomplete="bday" oninput="calculateAge()" />
                                                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                                            </div>

                                            <!-- Age (hidden) -->
                                            <input type="hidden" id="age" name="age" />

                                            <!-- Height -->
                                            <div class="mb-3">
                                                <label for="height" class="form-label">{{ __('Height (cm)') }}</label>
                                                <input type="number" class="form-control" id="height" name="height" :value="old('height')" required />
                                                <x-input-error :messages="$errors->get('height')" class="mt-2" />
                                            </div>

                                            <!-- Weight -->
                                            <div class="mb-3">
                                                <label for="weight" class="form-label">{{ __('Weight (kg)') }}</label>
                                                <input type="number" class="form-control" id="weight" name="weight" :value="old('weight')" required />
                                                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                                            </div>

                                            <!-- Activity Level -->
                                            <div class="mb-3">
                                                <label for="activity_level" class="form-label">{{ __('Activity Level') }}</label>
                                                <select id="activity_level" name="activity_level" class="form-control" required>
                                                    <option value="sedentary">Sedentary</option>
                                                    <option value="moderate">Moderate</option>
                                                    <option value="active">Active</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('activity_level')" class="mt-2" />
                                            </div>

                                            <!-- Fitness Goals -->
                                            <div class="mb-3">
                                                <label for="fitness_goal" class="form-label">{{ __('Fitness Goal') }}</label>
                                                <select id="fitness_goal" name="fitness_goal" class="form-control" required>
                                                    <option value="weight_loss">Weight Loss</option>
                                                    <option value="muscle_gain">Muscle Gain</option>
                                                    <option value="maintain_fitness">Maintain Fitness</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('fitness_goal')" class="mt-2" />
                                            </div>

                                            <!-- Dietary Preferences -->
                                            <div class="mb-3">
                                                <label for="dietary_preference" class="form-label">{{ __('Dietary Preference') }}</label>
                                                <select id="dietary_preference" name="dietary_preference" class="form-control" required>
                                                    <option value="none">None</option>
                                                    <option value="vegetarian">Vegetarian</option>
                                                    <option value="vegan">Vegan</option>
                                                    <option value="keto">Keto</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('dietary_preference')" class="mt-2" />
                                            </div>

                                            <!-- Medical Conditions -->
                                            <div class="mb-3">
                                                <label for="medical_conditions" class="form-label">{{ __('Medical Conditions') }}</label>
                                                <input type="text" class="form-control" id="medical_conditions" name="medical_conditions" :value="old('medical_conditions')" required />
                                                <x-input-error :messages="$errors->get('medical_conditions')" class="mt-2" />
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="submit" class="btn btn-primary text-white mb-2 mb-md-0">Finish</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function calculateAge() {
            const birthdayInput = document.getElementById('birthday').value;
            const birthdayDate = new Date(birthdayInput);
            const age = new Date().getFullYear() - birthdayDate.getFullYear();
            document.getElementById('age').value = age;
        }
    </script>
</body>
</html>
