@extends('polls.layout')

@section('content')
<div class="card p-5 shadow-lg border-0 bg-dark text-light poll-card">
    <h2 class="mb-4 fw-bold text-center display-6">Create a New Poll</h2>

    <form method="POST" action="{{ route('polls.store') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label fw-semibold fs-6">Poll Question</label>
            <input type="text" name="question" class="form-control form-control-lg bg-secondary text-light border-0 poll-input" placeholder="Enter your poll question" required>
        </div>

        <label class="form-label fw-semibold fs-6">Options</label>
        <div id="options" class="mb-3">
            <input type="text" name="options[]" class="form-control mb-3 bg-secondary text-light border-0 poll-input" placeholder="Option 1" required>
            <input type="text" name="options[]" class="form-control mb-3 bg-secondary text-light border-0 poll-input" placeholder="Option 2" required>
        </div>
        <button type="button" class="btn btn-outline-light mb-4" onclick="addOption()">
            <i class="fa-solid fa-plus"></i> Add Option
        </button>

        <div class="mb-4">
            <label class="form-label fw-semibold fs-6">Expires At (optional)</label>
            <input type="datetime-local" name="expires_at" class="form-control bg-secondary text-light border-0 poll-input">
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 fs-6">
            <i class="fa-solid fa-check"></i> Create Poll
        </button>
    </form>
</div>

<script>
function addOption() {
    const container = document.getElementById('options');
    const index = container.children.length + 1;
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'options[]';
    input.className = 'form-control mb-3 bg-secondary text-light border-0 poll-input';
    input.placeholder = 'Option ' + index;
    container.appendChild(input);
}
</script>
@endsection
