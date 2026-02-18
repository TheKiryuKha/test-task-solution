<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Task;
use App\Payloads\TaskPayload;
use Illuminate\Support\Facades\DB;

final readonly class CreateTask
{
    public function __construct(
        private UpdateTasksTags $action
    ) {}

    public function handle(TaskPayload $dto): Task
    {
        return DB::transaction(function () use ($dto): Task {

            $task = Task::query()->create($dto->toArray());

            $this->action->handle($task, $dto->getTags());

            return $task;
        });
    }
}
