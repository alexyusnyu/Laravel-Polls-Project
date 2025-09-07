@extends('polls.layout')

@section('content')
<h2 class="mb-4 fw-bold text-center display-5">Active Polls</h2>

@if($polls->count() === 0)
    <div class="alert alert-info text-center fs-5">
        <i class="fa-solid fa-info-circle me-2"></i>
        No polls available. Create one to get started!
    </div>
@endif

<div class="row g-4 justify-content-center">
    @foreach($polls as $poll)
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card h-100 p-4 shadow-lg border-0 poll-card">
            <h5 class="card-title fw-bold mb-3 fs-4">{{ $poll->question }}</h5>
            <p class="text-muted mb-3 fs-6">{{ $poll->options->count() }} Options</p>

            <a href="{{ route('polls.show', $poll) }}" class="btn btn-success w-100 mb-3 fw-semibold py-2 fs-6">
                <i class="fa-solid fa-eye me-2"></i> View & Vote
            </a>

            <form action="{{ route('polls.destroy', $poll) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this poll?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100 fw-semibold py-2 fs-6">
                    <i class="fa-solid fa-trash me-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@if($polls->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $polls->links('pagination::bootstrap-5') }}
</div>
@endif
@endsection
