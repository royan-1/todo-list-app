@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Dashboard Tugas</h2>

    {{-- Alert untuk tugas H-3 --}}
    @php
        use Carbon\Carbon;
        $today = Carbon::now();
        $hMinus3 = $today->copy()->addDays(3);

        $h3Tasks = $pending_tasks->filter(function($task) use ($hMinus3) {
            return !$task->is_completed && Carbon::parse($task->deadline)->lte($hMinus3);
        });
    @endphp

    @if($h3Tasks->count() > 0)
    <div class="alert alert-warning">
        <strong>⚠️ Peringatan!</strong> Ada {{ $h3Tasks->count() }} tugas yang akan jatuh tempo dalam 3 hari!
        <ul>
            @foreach($h3Tasks as $task)
                <li>{{ $task->title }} - Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Tugas Belum Selesai --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            Tugas Belum Selesai
        </div>
        <div class="card-body">
            @if($pending_tasks->count() > 0)
            <ul class="list-group">
                @foreach($pending_tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong><br>
                        Prioritas:
                        @php
                            $color = match($task->priority) {
                                'penting' => 'danger',
                                'lumayan penting' => 'warning',
                                'tidak penting' => 'secondary',
                                default => 'light'
                            };
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ ucfirst($task->priority) }}</span><br>
                        Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                    </div>
                    <div>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        {{-- Tombol Tandai Selesai --}}
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">Selesai</button>
                        </form>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus tugas ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-muted">Tidak ada tugas yang belum selesai.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">+ Tambah Tugas Baru</a>
    </div>
</div>
@endsection
