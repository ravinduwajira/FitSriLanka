@extends('Admin.admin_dashboard')

@section('Admin')
<div><br>
    <div class="container py-5">
        <h1 class="text-center mb-4">Manage Fitness Centers 🏋🏻‍♂️</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle" style="background-color: #d6d8db; color: #343a40;">
                <thead style="background-color: #c6c8ca; font-weight: bold;">
                    <tr>
                        <th>Fitness Center ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Monthly Fee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fitnessCenters as $center)
                    <tr style="border-bottom: 1px solid #b1b3b5; font-weight: bold;">
                        <td>{{ $center->fitnesscenterid }}</td>
                        <td>{{ $center->name }}</td>
                        <td>{{ $center->address }}</td>
                        <td>Rs.{{ $center->monthly_fee }}</td>
                        <td>
                            <form action="{{ route('Admin.fitnesscenter.delete', $center->fitnesscenterid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fitness center?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
