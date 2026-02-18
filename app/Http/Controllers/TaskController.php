<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTask;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskResource;

final readonly class TaskController
{
    public function store(CreateTaskRequest $request, CreateTask $action): TaskResource
    {
        $task = $action->handle($request->payload());

        return new TaskResource($task);
    }
}
