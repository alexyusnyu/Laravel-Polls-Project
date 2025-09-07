@extends('polls.layout')

@section('content')
<div class="card p-5 shadow-sm">
    <h3 class="fw-bold">{{ $poll->question }}</h3>

    @if($poll->expires_at && $poll->expires_at < now())
        <div class="alert alert-warning mt-3 text-center">This poll has expired.</div>
    @endif

    @if($poll->votes->count())
        <h5 class="mt-4 fw-semibold">Results:</h5>
        @foreach($poll->options as $option)
            @php
                $percent = $poll->votes->count() ? round(($option->votes->count() / $poll->votes->count()) * 100) : 0;
            @endphp
            <div class="mb-3">
                <strong>{{ $option->text }}</strong>
                <div class="vote-bar-container">
                    <div class="vote-bar" style="width: {{ $percent }}%;" data-percent="{{ $percent }}"></div>
                </div>
            </div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('polls.vote', $poll) }}" class="mt-4">
        @csrf
        @foreach($poll->options as $option)
            <div class="form-check mb-2">
                <input type="radio" name="option_id" value="{{ $option->id }}" class="form-check-input" required>
                <label class="form-check-label">{{ $option->text }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success mt-3 w-100 fw-bold">
            <i class="fa-solid fa-check"></i> Vote
        </button>
    </form>

    <form action="{{ route('polls.destroy', $poll) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this poll?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-100">
            <i class="fa-solid fa-trash"></i> Delete Poll
        </button>
    </form>
</div>
@endsection
