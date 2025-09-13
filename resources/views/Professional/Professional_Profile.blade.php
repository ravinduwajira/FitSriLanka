@extends('Professional.Professional_dashboard')
@section('Professional')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
  <div class="row profile-body">
    <!-- left wrapper start -->
    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
      <div class="card rounded">
        <div class="card-body">
          <div>
            <img class="wd-70 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
            <span class="h5 ms-3 mb-0">{{ $profileData->username }}</span>
          </div>
          <div class="d-flex align-items-centerm mb-2">
            <div></div>
            <br><br>
            <h6 class="card-title mb-0">About</h6>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Role:</label>
            <p class="text-muted">{{ $profileData->role }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
            <p class="text-muted">{{ $profileData->email }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
            <p class="text-muted">{{ $profileData->address }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
            <p class="text-muted">{{ $profileData->phone }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- left wrapper end -->
    <!-- middle wrapper start -->
    <div class="col-md-8 col-xl-9 middle-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Edit Admin Profile</h6>

              <form method="POST" action="{{ route('Professional.profile.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                  <label for="Inputname" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="Inputname" autocomplete="off" value="{{ $profileData->name }}" required>
                </div>

                <div class="mb-3">
                  <label for="InputUsername" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" id="InputUsername" autocomplete="off" value="{{ $profileData->username }}" required>
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ $profileData->email }}" required>
                </div>

                <div class="mb-3">
                  <label for="InputPhone" class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" id="InputPhone" value="{{ $profileData->phone }}" pattern="\d{10}" title="Phone number must be exactly 10 digits" required>
                </div>

                <div class="mb-3">
                  <label for="InputAddress" class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" id="InputAddress" value="{{ $profileData->address }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="Photo">Photo</label>
                  <input class="form-control" name="photo" type="file" id="photo">
                </div>

                <div class="mb-3">
                  <label for="Photo" class="form-label"> </label>
                  <img id="showImage" class="wd-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                </div>

                <button type="submit" class="btn btn-primary me-2">Update</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    
    <!-- middle wrapper end -->
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // Image preview on file input change
    $('#photo').change(function(e) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#showImage').attr('src', e.target.result);
      };
      reader.readAsDataURL(e.target.files[0]);
    });

    // Form validation for phone number
    $('form').submit(function(e) {
      var phone = $('#InputPhone').val();
      var phonePattern = /^\d{10}$/;

      if (!phonePattern.test(phone)) {
        alert('Phone number must be exactly 10 digits.');
        e.preventDefault(); // Prevent form submission if invalid
      }
    });
  });
</script>

@endsection
