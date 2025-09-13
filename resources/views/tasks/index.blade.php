@extends('dashboard')
@section('User')

<!-- Page Styles -->
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        .task-header {
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #6c757d, #007bff);
            color: white;
            border-radius: 10px;
        }

        .task-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .task-container {
            margin-top: 50px;
        }

        .task-form .input-group {
            max-width: 900px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .task-form input {
            border-radius: 0;
        }

        .task-form button {
            border-radius: 0;
        }

        .list-group {
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .list-group-item:nth-child(odd) {
            background-color: #e9ecef;
        }

        .task-details strong {
            font-size: 1.25rem;
            color: #343a40;
        }

        .task-buttons button {
            min-width: 130px;
            transition: transform 0.2s ease;
        }

        .task-buttons button:hover {
            transform: scale(1.05);
        }

        .task-buttons .btn-success {
            background-color: #28a745;
        }

        .task-buttons .btn-danger {
            background-color: #dc3545;
        }

        .alert {
            margin: 20px auto;
            max-width: 800px;
        }

        .input-group input {
            padding: 15px;
        }
    </style>
</head>
<div class="page-content">
    <!-- Task Manager Container -->
    <div class="container-fluid task-container">
        <!-- Page Title -->
        <div class="task-header text-center">
            <h1>Fit Sri Lanka Task Manager</h1>
            <p class="lead">Stay organized and track your health tasks. Add, complete, or delete tasks as you make progress on your fitness journey.</p>
        </div>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Task Creation Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4 task-form">
            @csrf
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="Task title" required>
                <input type="text" name="description" class="form-control" placeholder="Description (optional)">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-plus-circle"></i> Add Task
                    </button>
                </div>
            </div>
        </form>

        <!-- Task List -->
        <div class="list-group">
            @foreach ($tasks as $task)
                <div class="list-group-item">
                    <!-- Task Details Section -->
                    <div class="task-details">
                        <strong>{{ $task->title }}</strong>
                        <p class="mb-1 text-muted">{{ $task->description }}</p>
                    </div>

                    <!-- Buttons Section -->
                    <div class="task-buttons d-flex align-items-center">
                        <!-- Complete/Incomplete Button -->
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mr-2">
                            @csrf
                            @method('PATCH')
                            <button class="btn {{ $task->completed ? 'btn-success' : 'btn-secondary' }} btn-sm" type="submit">
                                <i class="fa {{ $task->completed ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                {{ $task->completed ? 'Completed' : 'Complete' }}
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Bootstrap and Font Awesome JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
