@extends('polls.layout')

@section('content')
<div class="card p-5 shadow-sm">
    <h3 class="mb-4 fw-bold">Create a New Poll</h3>
    <form method="POST" action="{{ route('polls.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Question</label>
            <input type="text" name="question" class="form-control" placeholder="Enter your poll question" required>
        </div>

        <label class="form-label fw-semibold">Options</label>
        <div id="options">
            <input type="text" name="options[]" class="form-control mb-3" placeholder="Option 1" required>
            <input type="text" name="options[]" class="form-control mb-3" placeholder="Option 2" required>
        </div>
        <button type="button" class="btn btn-secondary mb-4" onclick="addOption()">
            <i class="fa-solid fa-plus"></i> Add Option
        </button>

        <div class="mb-3">
            <label>Expires At (optional)</label>
            <input type="datetime-local" name="expires_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold">
            <i class="fa-solid fa-check"></i> Create Poll
        </button>
    </form>
</div>

<script>
function addOption() {
    let container = document.getElementById('options');
    let index = container.children.length + 1;
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'options[]';
    input.className = 'form-control mb-3';
    input.placeholder = 'Option ' + index;
    container.appendChild(input);
}
</script>
@endsection
