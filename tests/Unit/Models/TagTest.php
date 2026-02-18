<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\Task;

test('to array', function (): void {
    $tag = Tag::factory()->create()->refresh();

    expect(array_keys($tag->toArray()))
        ->toBe([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
});

test('tag can have tasks', function (): void {
    $tag = Tag::factory()->create();
    $task = Task::factory()->create();

    $tag->tasks()->attach($task);

    expect($tag->tasks)->toHaveCount(1);
    expect($tag->tasks->first()->id)->toBe($task->id);
});

test('tag can have multiple tasks', function (): void {
    $tag = Tag::factory()->create();
    $task1 = Task::factory()->create();
    $task2 = Task::factory()->create();

    $tag->tasks()->attach([$task1->id, $task2->id]);

    expect($tag->tasks)->toHaveCount(2);
});
