<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = Task::create($request->all());
            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Task creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['message' => 'Task not found'], 404);
            }

            $task->update($request->all());
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Task update failed', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['message' => 'Task not found'], 404);
            }

            $task->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Task deletion failed', 'error' => $e->getMessage()], 500);
        }
    }
}
