<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return Inertia::render('Task', ['tasks', $tasks]);
    }

    public function getList(){
        $tasks = Task::all();
        // return Inertia::render('Task', ['tasks', $tasks]);
        
        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $validationRequest)
    {
        $validatedData = $validationRequest->validated();

        $task = Task::create($validatedData);

        return response()->json(['message' => 'Task created successfully', 'data' => $task], 200)
        ->header('Refresh', '1');
    }

    public function edit(StoreTaskRequest $validationRequest, $id)
    {
        $task = Task::findOrFail($id); // Retrieve the task using the provided $id
        
        $validatedData = $validationRequest->validated(); // Get the validated data from the form request
    
        // Update the task with the validated data
        $task->update([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
            'status' => $validatedData['status'],
        ]);
    
        return response()->noContent();
    }

    public function destroy(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete();
        
        return response()->noContent();
    }
}
