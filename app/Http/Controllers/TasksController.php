<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_tasks = Tasks::where('user_id', auth()->user()->id)->get();

        return response($user_tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $task = $request->validate([
              'title' => 'required|string',
              'description' => 'required|string',
              'is_done' => 'required|boolean'
        ]);

         $task = Tasks::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'is_done' => $request['is_done'],
                'user_id' => auth()->user()->id
        ]);

        return response($task, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $task = Tasks::where('id' , $id)->where('user_id', auth()->user()->id)->first();

        if(!$task) return response(['message' => 'Task not found'], 404);

       return response($task, 200);
    }

    /**
     * Get weekly tasks marked as done.
    */
    public function get_weekly_tasks()
    {
        $weekly_tasks = Tasks::where('user_id', auth()->user()->id)
            ->where('is_done', true)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        return response($weekly_tasks, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Tasks::where('id' , $id)->where('user_id', auth()->user()->id)->first();
        if(!$task) return response(['message' => 'Task not found'], 404);
        $task->update($request->all());

        return response($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Tasks::where('id' , $id)->where('user_id', auth()->user()->id)->first();
        if(!$task) return response(['message' => 'Task not found'], 404);
        $task->delete();

        return response('Task deleted successfully', 200);
    }
}
