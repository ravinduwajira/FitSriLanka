@extends('dashboard')
@section('User')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded">
            <li class="breadcrumb-item"><a href="#">Fitness Centers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Enrollment</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="card-title mb-0">Fitness Center Enrollment Table</h6>
                        <p class="text-muted mb-0">This table displays the list of fitness centers with their details.</p>
                    </div>
                    <div class="mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Fitness Centers...">
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="searchable">Name</th>
                                    <th class="searchable">Address</th>
                                    <th>Monthly Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @php
                                    $anyEnrolled = \App\Models\FitnessCenterEnrollment::where('user_id', Auth::id())
                                        ->where('enrollment_status', 'enrolled')
                                        ->exists();
                                @endphp
                                @foreach($fitnessCenters as $center)
                                    @php
                                        $isEnrolled = \App\Models\FitnessCenterEnrollment::where('fitness_center_id', $center->fitnesscenterid)
                                            ->where('user_id', Auth::id())
                                            ->where('enrollment_status', 'enrolled')
                                            ->exists();
                                    @endphp
                                    <tr>
                                        <td class="searchable">{{ $center->name }}</td>
                                        <td class="searchable">{{ $center->address }}</td>
                                        <td>Rs.{{ $center->monthly_fee }}</td>
                                        <td>
                                            <form action="{{ route('toggleFitnessCenterEnrollment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="fitness_center_id" value="{{ $center->fitnesscenterid }}">
                                                <input type="hidden" name="fitness_center_name" value="{{ $center->name }}">
                                                <input type="hidden" name="User_name" value="{{ $profileData->name }}">
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
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.trim().toLowerCase(); // Ensure trimming whitespace
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('.searchable');
            const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none'; // Toggle display based on match
        });
    });
</script>

@endsection
