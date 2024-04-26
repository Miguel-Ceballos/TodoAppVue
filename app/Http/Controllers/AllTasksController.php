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
        return inertia('AllTasks/AllTasks', [
            'tasks' => auth()->user()->tasks,
            'categories' => auth()->user()->categories,
        ]);
    }

    public function store(TaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'category_id' => $request->category_id ?? null,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('inbox.index');
    }

    public function update(TaskRequest $request, Task $task)
    {
//        dd($task);
        $task->update($request->validated());
        return to_route('inbox.index');
    }

    public function destroy(Task $task)
    {
//        dd($task);
        $task->delete();
        return to_route('inbox.index');
    }
}
