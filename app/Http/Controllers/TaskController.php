<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('priority')) {
            $query->byPriority($request->priority);
        }

        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->completed();
            } elseif ($request->status === 'pending') {
                $query->pending();
            }
        }

        $tasks = $query->get();

        if ($request->ajax()) {
            return response()->json($tasks);
        }

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|in:work,personal,shopping,health,learning',
            'deadline' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();
        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'task' => $task,
            'message' => 'Task created successfully!'
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|required|in:low,medium,high',
            'category' => 'sometimes|required|in:work,personal,shopping,health,learning',
            'is_completed' => 'sometimes|boolean',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'task' => $task,
            'message' => 'Task updated successfully!'
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully!'
        ]);
    }

    public function toggle(Task $task)
    {
        $task->update(['is_completed' => !$task->is_completed]);

        return response()->json([
            'success' => true,
            'task' => $task,
            'message' => 'Task status updated!'
        ]);
    }
}
