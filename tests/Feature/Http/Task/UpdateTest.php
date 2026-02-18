<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\Task;

beforeEach(function (): void {
    $this->data = [
        'title' => fake()->title(),
        'is_done' => false,
        'due_at' => fake()->date('Y-m-d H:i:s'),
        'tags' => ['home', 'shopping', Tag::factory()->create()->name],
    ];
});

it("return's correct status code", function (): void {
    $task = Task::factory()->create();

    $response = $this->put(route('api:tasks:update', $task), $this->data);

    $response->assertStatus(200);
});

it("update's task", function (): void {
    $task = Task::factory()->create();

    $this->put(route('api:tasks:update', $task), $this->data);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => $this->data['title'],
        'is_done' => $this->data['is_done'],
        'due_at' => $this->data['due_at'],
    ]);
});

it("save's tags in database", function (): void {
    $task = Task::factory()->create();

    $this->put(route('api:tasks:update', $task), $this->data);

    $this->assertDatabaseCount('tags', 3);
});

it("connect's Task and Tags", function (): void {
    $task = Task::factory()->create();

    $this->put(route('api:tasks:update', $task), $this->data);

    expect(Task::query()->first()->tags)->toHaveCount(3);
});

it("return's correct data format", function (): void {
    $task = Task::factory()->create();

    $request = $this->put(route('api:tasks:update', $task), $this->data);

    $request->assertJsonStructure([
        'data' => [
            'id',
            'title',
            'is_done',
            'due_at',
            'created_at',
            'updated_at',
            'tags' => [
                '*' => [
                    'id',
                    'name',
                ],
            ],
        ],
    ]);
});

it("don't make tags null", function (): void {
    $task = Task::factory()->has(Tag::factory(3))->create();
    unset($this->data['tags']);

    $request = $this->put(route('api:tasks:update', $task), $this->data);

    expect($task->refresh()->first()->tags)->toHaveCount(3);
});
