<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Task;
use App\Payloads\TaskPayload;
use Illuminate\Support\Facades\DB;

final readonly class EditTask
{
    public function __construct(
        private UpdateTasksTags $action
    ) {}

    public function handle(Task $task, TaskPayload $dto): Task
    {
        return DB::transaction(function () use ($task, $dto): Task {

            $task->update($dto->toArray());

            if ($dto->getTags() !== []) {
                $this->action->handle($task, $dto->getTags());
            }

            return $task;
        });
    }
}
