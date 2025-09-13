@extends('Professional.Professional_dashboard')
@section('Professional')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<br>
<br>
<br>
<div class="container mt-5">
    
    <h1>Assign/Update Workout Plan for Client 📝</h1>

    <form id="workout-plan-form" method="POST" action="{{ route('Professional.workoutplan.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Select Client -->
       
        <div class="mb-3">
            <label for="client" class="form-label"></label>
            <select class="form-control" id="client" name="user_id" required>
                <option value="">-- Select a Client --</option>
                @foreach($enrolledClients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Workout Schedule -->
        <div class="form-group mt-3">
            <label for="workout_schedule">Workout Schedule</label>
            <textarea name="workout_schedule" id="workout_schedule" class="form-control" rows="10"></textarea>
        </div>

        <!-- Calorie Burn -->
        <div class="form-group mt-3">
            <label for="calorie_burn">Calorie Burn</label>
            <input type="number" name="calorie_burn" id="calorie_burn" class="form-control" min="0" step="1" >
        </div>


        <!-- Workout Benefits -->
        <div class="form-group mt-3">
            <label for="workout_benefits">Workout Benefits</label>
            <textarea name="workout_benefits" id="workout_benefits" class="form-control" rows="4"></textarea>
        </div>

        <!-- Workout Duration -->
        <div class="form-group mt-3">
            <label for="workout_duration">Workout Duration Guide</label>
            <textarea name="workout_duration" id="workout_duration" class="form-control" rows="4"></textarea>
        </div>

        <!-- Additional Info -->
        <div class="form-group mt-3">
            <label for="additional_info">Additional Information</label>
            <textarea name="additional_info" id="additional_info" class="form-control" rows="3"></textarea>
        </div>


        <!-- Workout Image Upload -->
        <div class="form-group mt-3">
            <label for="workout_image">Upload Workout Image</label>
            <input type="file" name="workout_image" id="workout_image" class="form-control" accept="image/*">
            <div id="image_preview" class="mt-2"></div> <!-- Display existing image -->
        </div>

        <!-- Workout Video Upload -->
        <div class="form-group mt-3">
            <label for="workout_video">Upload Workout Video</label>
            <input type="file" name="workout_video" id="workout_video" class="form-control" accept="video/*">
            <div id="video_preview" class="mt-2"></div> <!-- Display existing video -->
        </div>

        <!-- Submit and Update Buttons -->
        <button type="submit" class="btn btn-primary mt-4" id="submit-btn">Submit Workout Plan</button>
        <button type="button" class="btn btn-success mt-4" id="update-btn" style="display:none;">Update Workout Plan</button>
    </form>
</div>

<!-- jQuery -->
<script>
    $(document).ready(function() {
        // When client is selected
        $('#client').change(function() {
            var clientId = $(this).val();
            if (clientId) {
                // AJAX request to fetch the workout plan
                $.ajax({
                    url: "{{ route('Professional.workoutplan.fetch') }}",
                    type: 'GET',
                    data: { client_id: clientId },
                    success: function(response) {
                        if (response) {
                            // Populate the form with the workout plan data
                            $('#workout_schedule').val(response.workout_schedule || '');
                            $('#workout_benefits').val(response.workout_benefits || '');
                            $('#workout_duration').val(response.workout_duration || '');
                            $('#additional_info').val(response.additional_info || '');
                            $('#calorie_burn').val(response.calorie_burn || '');

                            // Clear file inputs (file inputs cannot be populated programmatically)
                            $('#workout_image').val('');
                            $('#workout_video').val('');

                            // Display existing image
                            if (response.workout_image) {
                                var imagePreview = `<p>Current Image: <a href="/assets/upload/workout_images/${response.workout_image}" target="_blank">View Image</a></p>`;
                                $('#image_preview').html(imagePreview);
                            } else {
                                $('#image_preview').html('');
                            }

                            // Display existing video
                            if (response.workout_video) {
                                var videoPreview = `<p>Current Video: <a href="/assets/upload/workout_videos/${response.workout_video}" target="_blank">View Video</a></p>`;
                                $('#video_preview').html(videoPreview);
                            } else {
                                $('#video_preview').html('');
                            }

                            // Hide submit button, show update button
                            $('#submit-btn').hide();
                            $('#update-btn').show().click(function() {
                                updateWorkoutPlan(clientId);
                            });
                        } else {
                            // Clear form and previews if no workout plan exists
                            $('#workout_schedule').val('');
                            $('#workout_benefits').val('');
                            $('#workout_duration').val('');
                            $('#additional_info').val('');
                            $('#calorie_burn').val('');
                            $('#image_preview').html('');
                            $('#video_preview').html('');

                            // Show submit button, hide update button
                            $('#submit-btn').show();
                            $('#update-btn').hide();
                        }
                    }
                });
            } else {
                // Clear the form if no client is selected
                $('#workout_schedule').val('');
                $('#workout_benefits').val('');
                $('#workout_duration').val('');
                $('#additional_info').val('');
                $('#calorie_burn').val('');
                $('#image_preview').html('');
                $('#video_preview').html('');

                // Show submit button, hide update button
                $('#submit-btn').show();
                $('#update-btn').hide();
            }
        });

        function updateWorkoutPlan(clientId) {
    var formData = new FormData($('#workout-plan-form')[0]);
    
    // Append additional fields to formData
    formData.append('_method', 'PUT'); // Override to use PUT method
    formData.append('client_id', clientId); // Attach client_id to formData

    $.ajax({
        url: "{{ route('Professional.workoutplan.update') }}", // Correct route for update
        type: 'POST', // Laravel expects POST method with '_method' => 'PUT'
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
           // alert('Workout Plan updated successfully!');
            location.reload();
        },
        error: function(xhr, status, error) {
            // Log the detailed error response
            console.error(xhr.responseText);
            alert('Error updating workout plan. Please try again.\nDetails: ' + xhr.responseText);
        }
    });
}

    });
</script>

@endsection
