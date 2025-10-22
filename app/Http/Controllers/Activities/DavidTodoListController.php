<?php

namespace App\Http\Controllers\Activities;

use App\Models\DavidTodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DavidTodoListController extends Controller
{
    public function index(Request $request)
    {
        $query = DavidTodoList::where('user_id', Auth::id());

        // Apply tab filter
        $tab = $request->query('tab', 'all');
        if ($tab !== 'all') {
            $query->where('status', $tab);
        } else {
            // Apply status filters for 'all' tab
            if ($request->has('filters')) {
                $filters = explode(',', $request->query('filters'));
                $query->whereIn('status', array_intersect($filters, ['pending', 'doing', 'finished']));
            }
        }

        // Apply sorting
        $sortBy = $request->query('sort_by', 'created_at');
        $sortOrder = $request->query('sort_order', 'desc');
        $validSorts = ['title', 'status', 'created_at'];
        $sortBy = in_array($sortBy, $validSorts) ? $sortBy : 'created_at';
        $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');

        $tasks = $query->paginate(12);

        return view('activities.DavidTodoList.index', compact('tasks'));
    }

    public function show(Request $request)
    {
        $task = DavidTodoList::where('id', $request->query('id'))
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'status' => 'required|in:pending,doing,finished',
        ]);

        $task = DavidTodoList::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'details' => $validated['details'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('david-todo-list.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:david_todo_lists,id',
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'status' => 'required|in:pending,doing,finished',
        ]);

        $task = DavidTodoList::where('id', $validated['id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->update([
            'title' => $validated['title'],
            'details' => $validated['details'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('david-todo-list.index')->with('success', 'Task updated successfully.');
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:david_todo_lists,id',
            'status' => 'required|in:pending,doing,finished',
        ]);

        $task = DavidTodoList::where('id', $validated['id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('david-todo-list.index')->with('success', 'Task status updated successfully.');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:david_todo_lists,id',
        ]);

        $task = DavidTodoList::where('id', $validated['id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->delete();

        return redirect()->route('david-todo-list.index')->with('success', 'Task deleted successfully.');
    }
}