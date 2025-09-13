@extends('Professional.Professional_dashboard')
@section('Professional')

<br><br><br><br>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Enrolled Users <span class="text-light">👥</span></h4>
        </div>
        <div class="card-body">
            @if($EnrollmentData->isEmpty())
                <div class="alert alert-warning text-center">
                    <strong>No clients are enrolled yet.</strong>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Client Email</th>
                                <th>Enrollment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($EnrollmentData as $index => $enrollment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $enrollment->user->name }}</td>
                                    <td>{{ $enrollment->user->email }}</td> 
                                    <td>{{ $enrollment->created_at->format('Y-m-d') }}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

<style>
    .container {
        max-width: 900px;
    }

    h1, h4 {
        font-family: 'Roboto', sans-serif;
    }

    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
        cursor: pointer;
    }

    .alert {
        background-color: #fff3cd;
        border-color: #ffeeba;
    }
</style>

@endsection
