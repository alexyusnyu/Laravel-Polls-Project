@extends('polls.layout')

@section('content')
<a href="{{ route('polls.create') }}" class="btn btn-primary mb-3">Create New Poll</a>

@foreach($polls as $poll)
<div class="card mb-2">
    <div class="card-body">
        <h5>{{ $poll->question }}</h5>
        <a href="{{ route('polls.show', $poll) }}" class="btn btn-sm btn-success mt-2">View / Vote</a>
    </div>
</div>
@endforeach

{{ $polls->links() }}
@endsection
