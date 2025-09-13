@extends('Professional.Professional_dashboard')
@section('Professional')
<br>
<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">{{ isset($editingFitnessCenter) ? 'Edit Fitness Center' : 'Add Fitness Center' }}</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($editingFitnessCenter) ? route('Professional.fitnesscenter.update', $editingFitnessCenter->fitnesscenterid) : route('Professional.fitnesscenter.store') }}">
                @csrf
                @if (isset($editingFitnessCenter))
                    @method('PUT')
                    <input type="hidden" name="fitnesscenterid" value="{{ $editingFitnessCenter->id }}">
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Fitness Center Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ $editingFitnessCenter->name ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $editingFitnessCenter->address ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="monthly_fee" class="form-label">Monthly Fee</label>
                    <input type="number" class="form-control" id="monthly_fee" name="monthly_fee"
                           value="{{ $editingFitnessCenter->monthly_fee ?? '' }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">{{ isset($editingFitnessCenter) ? 'Update' : 'Add' }} Fitness Center</button>
                    @if (isset($editingFitnessCenter))
                        <a href="{{ route('Professional.fitnesscenter.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mt-5 border-0">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Your Fitness Centers</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Monthly Fee (Rs.)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fitnessCenters as $center)
                        <tr>
                            <td>{{ $center->fitnesscenterid }}</td>
                            <td>{{ $center->name }}</td>
                            <td>{{ $center->address }}</td>
                            <td>Rs. {{ number_format($center->monthly_fee, 2) }}</td>
                            <td>
                                <a href="{{ route('Professional.fitnesscenter.index', ['edit_id' => $center->fitnesscenterid]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('Professional.fitnesscenter.delete', ['id' => $center->fitnesscenterid]) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
