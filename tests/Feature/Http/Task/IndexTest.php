<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\Task;

it("return's correct status code", function (): void {
    $this->get(
        route('api:tasks:index')
    )->assertStatus(
        200
    );
});

it("return's correct data format", function (): void {
    Task::factory(3)->has(Tag::factory(3))->create();

    $response = $this->get(route('api:tasks:index'));

    $response->assertJsonStructure([
        'data' => [
            '*' => [
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
        ],
    ]);
});

test('is_done filter', function (): void {
    Task::factory(2)->is_done(false)->create();
    Task::factory()->is_done(true)->create();

    $response = $this->get(route('api:tasks:index').'?is_done=0');

    $response->assertJsonCount(2, 'data');
});

test('tag name filter', function (): void {
    Task::factory(2)->create();
    Task::factory()->has(Tag::factory()->name('Home'))->create();

    $response = $this->get(route('api:tasks:index').'?tag=Home');

    $response->assertJsonCount(1, 'data');
});

test('q filter test', function (): void {
    Task::factory(2)->create();
    Task::factory()->title('lovely')->create();
    Task::factory()->title('loveless')->create();

    $response = $this->get(route('api:tasks:index').'?q=love');

    $response->assertJsonCount(2, 'data');
});

test('sort by created_at ascending', function (): void {
    $task1 = Task::factory()->create(['created_at' => now()->subDays(2)]);
    $task2 = Task::factory()->create(['created_at' => now()->subDay()]);
    $task3 = Task::factory()->create(['created_at' => now()]);

    $response = $this->get(route('api:tasks:index').'?sort=created_at&order=asc');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonPath('data.0.id', $task1->id)
        ->assertJsonPath('data.1.id', $task2->id)
        ->assertJsonPath('data.2.id', $task3->id);
});

test('sort by created_at descending', function (): void {
    $task1 = Task::factory()->create(['created_at' => now()->subDays(2)]);
    $task2 = Task::factory()->create(['created_at' => now()->subDay()]);
    $task3 = Task::factory()->create(['created_at' => now()]);

    $response = $this->get(route('api:tasks:index').'?sort=created_at&order=desc');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonPath('data.0.id', $task3->id)
        ->assertJsonPath('data.1.id', $task2->id)
        ->assertJsonPath('data.2.id', $task1->id);
});

test('sort by due_at ascending', function (): void {
    $task1 = Task::factory()->create(['due_at' => now()->addDay()]);
    $task2 = Task::factory()->create(['due_at' => now()->addWeek()]);
    $task3 = Task::factory()->create(['due_at' => now()->addMonth()]);
    $task4 = Task::factory()->create(['due_at' => null]);

    $response = $this->get(route('api:tasks:index').'?sort=due_at&order=asc');

    $response->assertStatus(200)
        ->assertJsonCount(4, 'data')
        ->assertJsonPath('data.0.id', $task1->id)
        ->assertJsonPath('data.1.id', $task2->id)
        ->assertJsonPath('data.2.id', $task3->id)
        ->assertJsonPath('data.3.id', $task4->id);
});

test('sort by due_at descending', function (): void {
    $task1 = Task::factory()->create(['due_at' => now()->addDay()]);
    $task2 = Task::factory()->create(['due_at' => now()->addWeek()]);
    $task3 = Task::factory()->create(['due_at' => now()->addMonth()]);
    $task4 = Task::factory()->create(['due_at' => null]);

    $response = $this->get(route('api:tasks:index').'?sort=due_at&order=desc');

    $response->assertStatus(200)
        ->assertJsonCount(4, 'data')
        ->assertJsonPath('data.0.id', $task3->id)
        ->assertJsonPath('data.1.id', $task2->id)
        ->assertJsonPath('data.2.id', $task1->id)
        ->assertJsonPath('data.3.id', $task4->id);
});
