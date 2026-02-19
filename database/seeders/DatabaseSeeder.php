<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::factory()->count(3)->create();
        $tasks = Task::factory()->count(30)->create();

        foreach ($tasks as $task) {
            $randomTagsCount = random_int(1, 3);
            $randomTags = $tags->random($randomTagsCount);

            $task->tags()->attach($randomTags);
        }
    }
}
