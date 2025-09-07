@extends('polls.layout')

@section('content')
<h3>{{ $poll->question }}</h3>

@if($poll->expires_at && $poll->expires_at < now())
<div class="alert alert-warning">This poll has expired.</div>
@endif

@if($poll->votes->count())
<ul class="list-group mb-3">
    @foreach($poll->options as $option)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $option->text }}
            <span class="badge bg-primary">{{ $option->votes->count() }} votes</span>
        </li>
    @endforeach
</ul>
@endif

@if(!$poll->expires_at || $poll->expires_at > now())
<form method="POST" action="{{ route('polls.vote', $poll) }}">
    @csrf
    @foreach($poll->options as $option)
        <div class="form-check">
            <input type="radio" name="option_id" value="{{ $option->id }}" class="form-check-input" required>
            <label class="form-check-label">{{ $option->text }}</label>
        </div>
    @endforeach
    <button type="submit" class="btn btn-success mt-2">Vote</button>
</form>
@endif
@endsection
