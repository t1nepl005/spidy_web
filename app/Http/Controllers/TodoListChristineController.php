<?php

namespace App\Http\Controllers;

use App\Models\TodoListChristine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListChristineController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index(Request $request)
    {
        // Get the filter value from the query string (e.g., ?status=Completed)
        $filter = $request->get('status');

        // Query the authenticated user's tasks, filter if applicable
        $tasks = TodoListChristine::where('user_id', Auth::id())
            ->when($filter, fn($query) => $query->where('status', $filter))
            ->orderBy('created_at', 'desc')
            ->get();

        // Return to your view in resources/views/activities/TodoListChristine/index.blade.php
        return view('activities.TodoListChristine.index', compact('tasks', 'filter'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        TodoListChristine::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
            'description' => $request->description,
        ]);

        return redirect()->route('todo.index')->with('success', 'Task added successfully!');
    }

    /**
     * Update the status of the specified task (Pending ↔ Completed).
     */
    public function updateStatus(Request $request, TodoListChristine $todoListChristine)
{
    if ($todoListChristine->user_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,completed',
    ]);

    $todoListChristine->status = $request->status;
    $todoListChristine->save();

    return back()->with('success', 'Task status updated to ' . $request->status . '!');
}


    /**
     * Remove the specified task from storage.
     */
    public function destroy(TodoListChristine $todoListChristine)
    {
        // Authorize: only the task owner can delete
        if ($todoListChristine->user_id !== Auth::id()) {
            abort(403);
        }

        $todoListChristine->delete();

        return back()->with('success', 'Task deleted successfully!');
    }
}
