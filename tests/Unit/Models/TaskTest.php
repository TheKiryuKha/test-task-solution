<?php

declare(strict_types=1);

use App\Models\Tag;
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

test('task can have tags', function (): void {
    $task = Task::factory()->create();
    $tag = Tag::factory()->create();

    $task->tags()->attach($tag);

    expect($task->tags)->toHaveCount(1);
    expect($task->tags->first()->id)->toBe($tag->id);
});

test('task can have multiple tags', function (): void {
    $task = Task::factory()->create();
    $tag1 = Tag::factory()->create();
    $tag2 = Tag::factory()->create();

    $task->tags()->attach([$tag1->id, $tag2->id]);

    expect($task->tags)->toHaveCount(2);
});
