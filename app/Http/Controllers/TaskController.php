<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTask;
use App\Actions\DeleteTask;
use App\Actions\EditTask;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\GetTasksRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Queries\GetTasks;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

final readonly class TaskController
{
    public function index(GetTasksRequest $request, GetTasks $query): AnonymousResourceCollection
    {
        $tasks = $query->get($request);

        return TaskResource::collection($tasks);
    }

    public function store(CreateTaskRequest $request, CreateTask $action): TaskResource
    {
        $task = $action->handle($request->payload());

        return new TaskResource($task);
    }

    public function update(Task $task, EditTaskRequest $request, EditTask $action): TaskResource
    {
        $action->handle($task, $request->payload());

        return new TaskResource($task);
    }

    public function destroy(Task $task, DeleteTask $action): JsonResponse
    {
        $action->handle($task);

        return response()->json(status: 204);
    }
}
