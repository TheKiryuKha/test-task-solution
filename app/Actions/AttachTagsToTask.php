<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

final readonly class AttachTagsToTask
{
    /**
     * @param  string[]  $tags
     */
    public function handle(Task $task, array $tags): void
    {
        DB::transaction(function () use ($task, $tags): void {

            $tagIds = [];

            foreach ($tags as $tag) {
                $tagIds[] = Tag::GetByName($tag)->id;
            }

            $task->tags()->sync($tagIds);

        });
    }
}
