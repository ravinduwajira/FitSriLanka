<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fit Sri Lanka - Professional Information</title>

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
                                        <h5 class="text-muted fw-normal mb-4">Provide your professional information.</h5>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('Professional.info.store') }}" enctype="multipart/form-data">
                                            @csrf

                                            <!-- Birthday -->
                                            <div class="mb-3">
                                                <label for="birthday" class="form-label">{{ __('Birthday') }}</label>
                                                <input type="date" class="form-control" id="birthday" name="birthday" :value="old('birthday')" required autocomplete="bday" oninput="calculateAge()" />
                                                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                                            </div>

                                            <!-- Age (Hidden) -->
                                            <input type="hidden" id="age" name="age" />

                                            <!-- Certifications -->
                                            <div class="mb-3">
                                                <label for="certifications" class="form-label">{{ __('Certifications') }}</label>
                                                <textarea id="certifications" class="form-control" name="certifications" rows="4" required>{{ old('certifications') }}</textarea>
                                                <x-input-error :messages="$errors->get('certifications')" class="mt-2" />
                                            </div>

                                            <!-- Years of Experience -->
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">{{ __('Years of Experience') }}</label>
                                                <input type="number" class="form-control" id="experience" name="experience" :value="old('experience')" required min="1" max="50" />
                                                <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                                            </div>

                                            <!-- Specializations -->
                                            <div class="mb-3">
                                                <label for="specializations" class="form-label">{{ __('Specializations') }}</label>
                                                <textarea id="specializations" class="form-control" name="specializations" rows="4" required>{{ old('specializations') }}</textarea>
                                                <x-input-error :messages="$errors->get('specializations')" class="mt-2" />
                                            </div>

                                            <!-- Professional Bio -->
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">{{ __('Professional Bio') }}</label>
                                                <textarea id="bio" class="form-control" name="bio" rows="4" required>{{ old('bio') }}</textarea>
                                                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                            </div>

                                            <!-- Programs Offered -->
                                            <div class="mb-3">
                                                <label for="programs" class="form-label">{{ __('Programs Offered') }}</label>
                                                <textarea id="programs" class="form-control" name="programs" rows="4" required>{{ old('programs') }}</textarea>
                                                <x-input-error :messages="$errors->get('programs')" class="mt-2" />
                                            </div>

                                            <!-- Monthly Fee -->
                                            <div class="mb-3">
                                                <label for="monthly_fee" class="form-label">{{ __('Monthly Fee') }}</label>
                                                <input type="number" class="form-control" id="monthly_fee" name="monthly_fee" :value="old('monthly_fee')" required min="0" step="0.01" />
                                                <x-input-error :messages="$errors->get('monthly_fee')" class="mt-2" />
                                            </div>

                                

                                            <!-- Terms & Conditions -->
                                            <div class="mb-3">
                                                <label for="terms" class="form-label">{{ __('Agree to Terms & Conditions') }}</label>
                                                <div class="form-check">
                                                    <input id="terms" type="checkbox" class="form-check-input" name="terms" required>
                                                    <label class="form-check-label" for="terms">{{ __('I agree to the terms and conditions') }}</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <a class="text-muted text-sm" href="{{ route('login') }}">
                                                    {{ __('Already registered?') }}
                                                </a>
                                                <button type="submit" class="btn btn-primary text-white mb-2 mb-md-0">{{ __('Finish') }}</button>
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
