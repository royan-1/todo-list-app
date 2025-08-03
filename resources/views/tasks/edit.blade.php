@extends('layouts.app')

@section('content')
<h2>Edit Tugas</h2>

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Deadline</label>
        <input type="date" name="deadline" class="form-control" value="{{ $task->deadline->format('Y-m-d') }}" required>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="is_completed" value="1" class="form-check-input"
            {{ $task->is_completed ? 'checked' : '' }}>
        <label class="form-check-label">Tugas Selesai</label>
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Prioritas</label>
        <select name="priority" class="form-select" required>
            <option value="tidak penting" {{ $task->priority == 'tidak penting' ? 'selected' : '' }}>Tidak Penting</option>
            <option value="lumayan penting" {{ $task->priority == 'lumayan penting' ? 'selected' : '' }}>Lumayan Penting</option>
            <option value="penting" {{ $task->priority == 'penting' ? 'selected' : '' }}>Penting</option>
        </select>
    </div>


    <button class="btn btn-primary">Update</button>
</form>
@endsection