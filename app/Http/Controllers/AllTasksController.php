<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllTasksController extends Controller
{
    public function index()
    {
        $tasks = DB::table('category_task')
            ->select('*')
            ->rightJoin('tasks', 'category_task.task_id', '=', 'tasks.id')
            ->where('user_id', '=', auth()->user()->id)
            ->where('status', '=', 0)
            ->get();

        return inertia('AllTasks/AllTasks', [
            'tasks' => $tasks,
            'categories' => auth()->user()->categories,
        ]);
    }

    public function store(TaskRequest $request)
    {
        $categoryTask = $request->category_id;
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'user_id' => auth()->user()->id
        ]);
        if ( $categoryTask ) Category::find($categoryTask)->tasks()->attach([ $task->id ]);

        return redirect()->route('inbox.index');
    }

    public function update(TaskRequest $request, Task $task)
    {
        if ( $request->category_id ) {
            if ( $this->isExistTask($task->id)[0]->category_id ) {
                Category::find($this->isExistTask($task->id)[0]->category_id)->tasks()->detach($task->id);
            }
            Category::find($request->category_id)->tasks()->attach([ $task->id ]);
        }

        $task->update($request->validated());
        return to_route('inbox.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return to_route('inbox.index');
    }

    public function isExistTask($task_id)
    {
        return DB::table('category_task')
            ->select('category_id')
            ->where('task_id', '=', $task_id)
            ->get();
    }
}
