<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Task;
use App\Services\TaskQueryBuilder\IsDoneFilter;
use App\Services\TaskQueryBuilder\Sorter;
use App\Services\TaskQueryBuilder\TagNameFilter;
use App\Services\TaskQueryBuilder\TaskQueryBuilder;
use App\Services\TaskQueryBuilder\TitleFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class GetTasks
{
    /**
     * @return LengthAwarePaginator<int, Task>
     */
    public function get(Request $request): LengthAwarePaginator
    {
        $query = Task::query()->with('tags');

        /** @var int $per_page */
        $per_page = $request->input('per_page');

        $query = new TaskQueryBuilder($query, $request)
            ->addModifier(new IsDoneFilter())
            ->addModifier(new TagNameFilter())
            ->addModifier(new TitleFilter())
            ->addModifier(new Sorter())
            ->getQuery();

        return $query->paginate($per_page)->withQueryString();
    }
}
