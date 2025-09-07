@extends('polls.layout')

@section('content')
<div class="card p-5 shadow-lg border-0 poll-card">
    <h2 class="fw-bold mb-4 display-6">{{ $poll->question }}</h2>

    @if($poll->expires_at && $poll->expires_at < now())
        <div class="alert alert-warning text-center fs-5">This poll has expired.</div>
    @endif

    @if($poll->votes->count())
        <h5 class="mt-4 mb-3 fw-semibold fs-5">Results:</h5>
        @foreach($poll->options as $option)
            @php
                $percent = $poll->votes->count() ? round(($option->votes->count() / $poll->votes->count()) * 100) : 0;
            @endphp
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1 fs-6">
                    <span>{{ $option->text }}</span>
                    <span>{{ $percent }}%</span>
                </div>
                <div class="vote-bar-container">
                    <div class="vote-bar" style="width: {{ $percent }}%;"></div>
                </div>
            </div>
        @endforeach
    @endif

    @if(!$poll->expires_at || $poll->expires_at >= now())
        <form method="POST" action="{{ route('polls.vote', $poll) }}" class="mt-4">
            @csrf
            @foreach($poll->options as $option)
                <div class="form-check mb-3">
                    <input type="radio" name="option_id" value="{{ $option->id }}" class="form-check-input" required id="option{{ $option->id }}">
                    <label class="form-check-label fw-medium fs-6" for="option{{ $option->id }}">{{ $option->text }}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-success w-100 fw-bold py-2 fs-6">
                <i class="fa-solid fa-check"></i> Vote
            </button>
        </form>
    @endif

    <form action="{{ route('polls.destroy', $poll) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this poll?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-100 py-2 fs-6">
            <i class="fa-solid fa-trash"></i> Delete Poll
        </button>
    </form>
</div>
@endsection
