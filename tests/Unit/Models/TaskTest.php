<?php

declare(strict_types=1);

use App\Models\Task;

test('to array', function (): void {
    $task = Task::factory()->create()->refresh();

    expect(array_keys($task->toArray()))
        ->toBe([
            'id',
            'title',
            'is_done',
            'due_at',
            'created_at',
            'updated_at',
        ]);
});
