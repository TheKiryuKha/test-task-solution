<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface TaskQueryModifierInterface
{
    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function modify(Request $request, Builder $query): Builder;
}
