<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // <<< TAMBAHKAN BARIS INI

class TaskController extends Controller
{
    use AuthorizesRequests; // <<< TAMBAHKAN BARIS INI

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        $today = Carbon::today();
        $alert_date = $today->copy()->addDays(3);

        $tasks = Task::where('user_id', Auth::id())->get();
        $upcoming_alerts = $tasks->filter(function ($task) use ($alert_date) {
            return !$task->is_completed && Carbon::parse($task->deadline)->lte($alert_date);
        });

        $pending_tasks = $tasks->where('is_completed', false);

        return view('dashboard', compact('tasks', 'pending_tasks', 'upcoming_alerts'));
    }


    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date',

        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'is_completed' => false,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->only('title', 'description', 'deadline', 'is_completed', 'priority'));
        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    public function markAsComplete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'is_completed' => true,
        ]);
        // Jika tugas sudah selesai, set deadline ke null
        return redirect()->back()->with('success', 'Tugas ditandai sebagai selesai.');
    }
}
