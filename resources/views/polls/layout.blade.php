<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Polls')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4 rounded-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('polls.index') }}">Laravel Polls</a>
            <div class="d-flex">
                <a href="{{ route('polls.create') }}" class="btn btn-primary me-2">
                    <i class="fa-solid fa-plus"></i> Create Poll
                </a>
                <a href="{{ route('polls.index') }}" class="btn btn-outline-light">
                    <i class="fa-solid fa-list"></i> All Polls
                </a>
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    <div class="container mb-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
