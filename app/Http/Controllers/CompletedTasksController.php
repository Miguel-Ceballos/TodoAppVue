<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompletedTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = DB::table('category_task')
            ->select('*')
            ->rightJoin('tasks', 'category_task.task_id', '=', 'tasks.id')
            ->where('user_id', '=', auth()->user()->id)
            ->where('status', '=', 1)
            ->get();

        return inertia('AllTasks/CompletedTasks', [ 'tasks' => $tasks, 'categories' => auth()->user()->categories ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
//        if ( $request->category_id ) {
//            if ( $this->isExistTask($task->id)[0]->category_id ) {
//                Category::find($this->isExistTask($task->id)[0]->category_id)->tasks()->detach($task->id);
//            }
//            Category::find($request->category_id)->tasks()->attach([ $task->id ]);
//        }

        $task->update($request->validated());
        return to_route('completed-tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function returnCompletedTasks($id) : object
    {
        //dd($id);
        if ( $id > 0 ) {
            return DB::table('category_task')
                ->select('*')
                ->rightJoin('tasks', 'category_task.task_id', '=', 'tasks.id')
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 1)
                ->where('category_id', '=', $id)
                ->get();
        } else {
            return DB::table('category_task')
                ->select('*')
                ->rightJoin('tasks', 'category_task.task_id', '=', 'tasks.id')
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 1)
                ->get();
        }
    }
}
