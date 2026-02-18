<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTask;
use App\Actions\EditTask;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

final readonly class TaskController
{
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
}
