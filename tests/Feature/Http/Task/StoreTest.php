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
    $this->post(
        route('api:tasks:store', $this->data)
    )->assertStatus(
        201
    );
});

it("create's task", function (): void {
    $this->post(route('api:tasks:store'), $this->data);

    $this->assertDatabaseHas('tasks', [
        'title' => $this->data['title'],
        'is_done' => $this->data['is_done'],
        'due_at' => $this->data['due_at'],
    ]);
});

it("save's tags in database", function (): void {
    $this->post(route('api:tasks:store'), $this->data);

    $this->assertDatabaseCount('tags', 3);
});

it("connect's Task and Tags", function (): void {
    $this->post(route('api:tasks:store'), $this->data);

    expect(Task::query()->first()->tags)->toHaveCount(3);
});

it("return's correct data format", function (): void {
    $request = $this->post(route('api:tasks:store'), $this->data);

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
