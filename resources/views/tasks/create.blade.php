@extends('layouts.app')

@section('content')
<h2>Buat Tugas Baru</h2>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Judul Tugas</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Deadline</label>
        <input type="date" name="deadline" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Prioritas</label>
        <select name="priority" class="form-select" required>
            <option value="tidak penting">Tidak Penting</option>
            <option value="lumayan penting" selected>Lumayan Penting</option>
            <option value="penting">Penting</option>
        </select>
    </div>


    <button class="btn btn-success">Simpan</button>


</form>
@endsection