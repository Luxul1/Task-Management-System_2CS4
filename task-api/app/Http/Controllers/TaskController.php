<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET ALL TASKS
    public function index()
    {
        return response()->json(Task::all());
    }

    // CREATE TASK
    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending'
        ]);

        return response()->json($task, 201);
    }

    // GET SINGLE TASK
    public function show($id)
    {
        return response()->json(Task::findOrFail($id));
    }

    // UPDATE TASK
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title ?? $task->title,
            'description' => $request->description ?? $task->description,
            'status' => $request->status ?? $task->status
        ]);

        return response()->json($task);
    }

    // DELETE TASK
    public function destroy($id)
    {
        Task::destroy($id);

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}