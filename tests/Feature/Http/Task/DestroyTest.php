<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\Task;

it("return's correct status code", function (): void {
    $task = Task::factory()->has(Tag::factory(3))->create();

    $response = $this->delete(route('api:tasks:destroy', $task));

    $response->assertStatus(204);
});

it("delete's task", function (): void {
    $task = Task::factory()->has(Tag::factory(3))->create();

    $this->delete(route('api:tasks:destroy', $task));

    $this->assertDatabaseMissing('tasks', $task->toArray());
});

it('keeps tags', function (): void {
    $task = Task::factory()->has(Tag::factory(3))->create();

    $this->delete(route('api:tasks:destroy', $task));

    $this->assertDatabaseCount('tags', 3);
});
