<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class TitleFilter implements TaskQueryModifierInterface
{
    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function modify(Request $request, Builder $query): Builder
    {
        if ($request->filled('q')) {

            /** @var string $title */
            $title = $request->input('q');

            $query->where('title', 'like', '%'.$title.'%');
        }

        return $query;
    }
}
