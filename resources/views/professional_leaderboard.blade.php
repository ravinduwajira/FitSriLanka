@extends('dashboard')

@section('User')

<div class="container my-5">
<br>
    <br><!-- Leaderboard Section -->
    <h1 class="text-center mb-5 display-4 fw-bold">🏆 Top 10 Fitness Professionals Leaderboard</h1>

    <div class="card shadow-sm mb-5">
        <div class="card-body p-4">
            <ol class="list-group list-group-numbered">
                @foreach($topProfessionals as $professional)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 position-relative">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($professional->name) }}&size=50&background=random" class="rounded-circle" alt="Avatar">
                            </div>
                            <span class="fs-5 fw-semibold">{{ $professional->name }}</span>
                        </div>
                        <span class="badge bg-primary fs-6 p-2">⭐ Score: {{ number_format($professional->avg_score, 2) }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <!-- Feedback Form for Users -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">📝 Submit Feedback for Your Assigned Professional</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('feedback.professional.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Your Assigned Professional:</label>
                    <p class="form-control-plaintext fs-5">{{ $assignedProfessional->professional_name }}</p>
                    <input type="hidden" name="professional_id" value="{{ $assignedProfessional->professional_id }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Score (1-5):</label>
                    <input type="number" name="score" class="form-control" min="1" max="5" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Feedback:</label>
                    <textarea name="feedback" class="form-control" rows="4" placeholder="Share your thoughts..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-semibold">Submit Feedback</button>
            </form>
        </div>
    </div>

    <!-- Received Feedback Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">📬 Your Received Feedback</h3>
        </div>
        <div class="card-body p-4">
            @if($receivedFeedbacks->isNotEmpty())
                <ul class="list-group">
                    @foreach($receivedFeedbacks as $feedback)
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block">From Professional:</strong> 
                                    <span class="fs-5">{{ $feedback->professional->name }}</span>
                                </div>
                                <span class="badge bg-success fs-6 p-2">⭐ {{ $feedback->score }}</span>
                            </div>
                            <p class="mt-2">{{ $feedback->feedback }}</p>
                            <small class="text-muted d-block">Received on: {{ $feedback->created_at->format('d M Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted text-center fs-5 py-4">You haven't received any feedback yet.</p>
            @endif
        </div>
    </div>

</div>

<style>
    /* Avatar Styling */
    .avatar img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    /* List Group Numbered Styling */
    .list-group-numbered {
        counter-reset: leaderboard-counter;
        padding-left: 0;
    }

    .list-group-numbered .list-group-item {
        counter-increment: leaderboard-counter;
        padding-left: 3rem;
        position: relative;
        border: none;
        border-bottom: 1px solid #eaeaea;
        transition: background-color 0.3s, transform 0.2s;
    }

    .list-group-numbered .list-group-item::before {
        content: counter(leaderboard-counter);
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background-color: #4CAF50;
        color: #fff;
        width: 2rem;
        height: 2rem;
        line-height: 2rem;
        text-align: center;
        font-weight: bold;
        border-radius: 50%;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    }

    /* Hover Effects */
    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px);
    }

    /* Button Styling */
    .btn-primary {
        background-color: #4CAF50;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-primary:hover {
        background-color: #45a049;
        transform: translateY(-2px);
    }

    /* Card Styling */
    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-radius: 12px 12px 0 0;
    }

    .badge {
        border-radius: 12px;
    }
</style>

@endsection
