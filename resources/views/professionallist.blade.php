@extends('dashboard')
@section('User')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Professional Enrollment</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="card-title mb-0">Professional Enrollment Table</h6>
                        <p class="text-muted mb-0">List of enrolled professionals and their details.</p>
                    </div>
                    <div class="mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Professionals...">
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Certifications</th>
                                    <th>Specializations</th>
                                    <th>Experience (Years)</th>
                                    <th>Bio</th>
                                    <th>Programs</th>
                                    <th>Monthly Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @php
                                    $anyEnrolled = \App\Models\ProfessionalEnrollment::where('user_id', Auth::id())
                                        ->where('enrollment_status', 'enrolled')
                                        ->exists();
                                @endphp
                                @foreach($professionalData as $professional)
                                    @php
                                        $profile = $profileData->firstWhere('id', $professional->id);
                                        $isEnrolled = \App\Models\ProfessionalEnrollment::where('professional_id', $professional->id)
                                            ->where('user_id', Auth::id())
                                            ->where('enrollment_status', 'enrolled')
                                            ->exists();
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($profile && $profile->photo)
                                                <img src="{{ asset('upload/admin_images/' . $profile->photo) }}" alt="Photo of {{ $profile->name }}" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @else
                                                <img src="{{ asset('upload/admin_images/default.png') }}" alt="Default Photo" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td class="searchable">{{ $profile->name ?? 'N/A' }}</td>
                                        <td class="searchable">{{ $professional->certifications }}</td>
                                        <td class="searchable">{{ $professional->specializations }}</td>
                                        <td>{{ $professional->experience }}</td>
                                        <td>{{ $professional->bio }}</td>
                                        <td>{{ $professional->programs }}</td>
                                        <td>Rs.{{ $professional->monthly_fee }}</td>
                                        <td>
                                            <form action="{{ route('toggleEnrollment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                                                <input type="hidden" name="professional_name" value="{{ $profile->name }}">
                                                <input type="hidden" name="enrollment_status" value="{{ $isEnrolled ? 'unenrolled' : 'enrolled' }}">
                                                <button type="submit" class="btn btn-sm {{ $isEnrolled ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                    {{ $anyEnrolled && !$isEnrolled ? 'disabled' : '' }}>
                                                    {{ $isEnrolled ? 'Unenroll' : 'Enroll' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('.searchable');
            const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });
</script>

@endsection
