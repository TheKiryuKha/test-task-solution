<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final readonly class TagNameFilter implements TaskQueryModifierInterface
{
    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function modify(Request $request, Builder $query): Builder
    {
        if ($request->filled('tag')) {
            $query->whereHas('tags', function (Builder $query) use ($request): void {
                $query->where('name', $request->input('tag'));
            });
        }

        return $query;
    }
}
