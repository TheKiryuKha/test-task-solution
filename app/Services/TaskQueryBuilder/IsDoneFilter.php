<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final readonly class IsDoneFilter implements TaskQueryModifierInterface
{
    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function modify(Request $request, Builder $query): Builder
    {
        if ($request->has('is_done')) {
            $query->where('is_done', $request->boolean('is_done'));
        }

        return $query;
    }
}
