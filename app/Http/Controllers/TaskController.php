<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Status;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        return inertia('Tasks/Index', [ 'tasks' => $category->tasks, 'category' => $category ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        return inertia('Tasks/Create', [ 'statuses' => auth()->user()->statuses, 'category' => $category ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Category $category)
    {

//        dd($request);
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $category->id,
            'status_id' => $request->status_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('tasks.index', $category->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Task $task)
    {
        return inertia('Tasks/Edit', [ 'task' => $task, 'statuses' => Status::all(), 'category' => $category ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index', $category->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
