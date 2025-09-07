@extends('polls.layout')

@section('content')
<form method="POST" action="{{ route('polls.store') }}">
    @csrf
    <div class="mb-3">
        <label>Question</label>
        <input type="text" name="question" class="form-control" required>
    </div>

    <label>Options</label>
    <div id="options">
        <input type="text" name="options[]" class="form-control mb-1" placeholder="Option 1" required>
        <input type="text" name="options[]" class="form-control mb-1" placeholder="Option 2" required>
    </div>
    <button type="button" class="btn btn-secondary mb-3" onclick="addOption()">Add Option</button>

    <div class="mb-3">
        <label>Expires At (optional)</label>
        <input type="datetime-local" name="expires_at" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Create Poll</button>
</form>

<script>
function addOption() {
    let container = document.getElementById('options');
    let index = container.children.length + 1;
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'options[]';
    input.className = 'form-control mb-1';
    input.placeholder = 'Option ' + index;
    container.appendChild(input);
}
</script>
@endsection
