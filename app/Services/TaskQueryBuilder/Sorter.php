<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final readonly class Sorter implements TaskQueryModifierInterface
{
    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function modify(Request $request, Builder $query): Builder
    {
        /** @var string $sort */
        $sort = $request->input('sort', 'created_at');

        /** @var string $order */
        $order = $request->input('order', 'desc');

        if ($sort === 'due_at') {
            return $query
                ->orderByRaw('due_at IS NULL')
                ->orderBy('due_at', $order);
        }

        return $query->orderBy($sort, $order);
    }
}
