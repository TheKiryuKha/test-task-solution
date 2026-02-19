<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
final class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'is_done' => false,
            'due_at' => fake()->dateTime(),
        ];
    }

    public function is_done(bool $is_done): self
    {
        return $this->state(fn (array $attributes): array => [
            'is_done' => $is_done,
        ]);
    }

    public function title(string $title): self
    {
        return $this->state(fn (array $attributes): array => [
            'title' => $title,
        ]);
    }
}
