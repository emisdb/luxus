<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Task $task)
    {
        // Paginate the results
        $tasks = $task->search($request);

        // Return paginated results using the TaskResource
        return TaskResource::collection($tasks);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = Task::create($validatedData);
            return response()->json( new TaskResource($task), 200 );

            // Return success response or redirect
        } catch (ValidationException $e) {
            // Validation failed, handle the error
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        try {
            $validatedData = $request->validated();
            $task->update($validatedData);
           return response()->json(data: new TaskResource($task),status: 200 );

            // Return success response or redirect
        } catch (ValidationException $e) {
            // Validation failed, handle the error
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
