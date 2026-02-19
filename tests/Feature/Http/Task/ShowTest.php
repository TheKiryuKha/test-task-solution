<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\Task;

it("return's correct status code", function (): void {
    $this->get(
        route('api:tasks:show', Task::factory()->create())
    )->assertStatus(
        200
    );
});

it("return's correct data format", function (): void {
    $task = Task::factory()->has(Tag::factory(3))->create();

    $response = $this->get(route('api:tasks:show', $task));

    $response->assertJsonStructure([
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
