<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class AllTasksController extends Controller
{
    public function index()
    {
        return inertia('Tasks/AllTasks', [
            'tasks' => auth()->user()->tasks,
            'statuses' => auth()->user()->statuses,
            'categories' => auth()->user()->categories,
        ]);
    }

    public function store(TaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('inbox.index');
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('inbox.index');
    }

    public function destroy(Task $task)
    {
//        dd($task);
        $task->delete();
        return to_route('inbox.index');
    }
}
