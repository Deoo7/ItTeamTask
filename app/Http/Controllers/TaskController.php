<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        return Inertia::render('Task');
    }

    public function store(StoreTaskRequest $request)
    {
        $validatedData = $request->validated();

        $task = Task::create($validatedData);

        return response()->json(['message' => 'Task created successfully', 'data' => $task], 200)
        ->header('Refresh', '1');
    }
}
