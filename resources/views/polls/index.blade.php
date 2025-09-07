@extends('polls.layout')

@section('content')
<h2 class="mb-4 fw-bold">Active Polls</h2>

@if($polls->count() === 0)
    <div class="alert alert-info text-center">No polls available. Create one to get started!</div>
@endif

<div class="row g-4">
    @foreach($polls as $poll)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 p-4">
            <h5 class="card-title fw-bold">{{ $poll->question }}</h5>
            <p class="text-muted mb-3">{{ $poll->options->count() }} Options</p>
            <a href="{{ route('polls.show', $poll) }}" class="btn btn-success w-100">
                <i class="fa-solid fa-eye"></i> View & Vote
            </a>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $polls->links() }}
</div>
@endsection
