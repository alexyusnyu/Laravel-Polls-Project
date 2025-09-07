<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Polls</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg mb-5">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold" href="{{ route('polls.index') }}">
            <i class="fa-solid fa-poll"></i> Laravel Polls
        </a>

        <div class="ms-auto d-flex gap-2">
            <a class="btn btn-success" href="{{ route('polls.index') }}">
                <i class="fa-solid fa-list"></i> View All Polls
            </a>
            <a class="btn btn-light" href="{{ route('polls.create') }}">
                <i class="fa-solid fa-plus"></i> Create Poll
            </a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert text-center">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
