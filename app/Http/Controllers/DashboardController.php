<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $tasks = auth()->user()->todos; 

        return view('dashboard', compact('tasks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $task = new Task();
        $task->name = $request->task;
        $task->user_id = auth()->id();
        $task->save();

        return redirect()->back()->with('success', 'Task added successfully.');
    }
        public function edit(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['task' => 'required|string|max:255']);
        $task->update(['name' => $request->task]);
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }


}
