<?php

namespace App\Domain\Task\Controllers;

use App\Domain\Task\Requests\TaskRequest;
use App\Domain\Task\Resources\TaskResource;
use App\Domain\Task\Services\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            "message" => "Tasks retrieved successfully",
            "data" => TaskResource::collection($this->taskService->retrieveTasks($request))->additional(['meta' => [
                'key' => 'value',
            ]])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $taskRequest)
    {
        $data = $this->taskService->create($taskRequest);
        return response()->json([
            "message" => "Task created successfully",
            "data" => TaskResource::make($data)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->taskService->retrieveTask($id);

        return response()->json([
            "message" => "Task retrieved successfully",
            "data" => TaskResource::make($data)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->taskService->updateTask($request, $id);

        return response()->json([
            "message" => "Task updated successfully",
            "data" => TaskResource::make($data)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
