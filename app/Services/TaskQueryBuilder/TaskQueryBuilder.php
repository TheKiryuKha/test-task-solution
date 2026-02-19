<?php

declare(strict_types=1);

namespace App\Services\TaskQueryBuilder;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class TaskQueryBuilder
{
    /** @var TaskQueryModifierInterface[] */
    private array $filters;

    /**
     * @param  Builder<Task>  $query
     */
    public function __construct(private Builder $query, private readonly Request $request) {}

    public function addModifier(TaskQueryModifierInterface $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @return Builder<Task>
     */
    public function getQuery(): Builder
    {
        foreach ($this->filters as $filter) {
            $this->query = $filter->modify($this->request, $this->query);
        }

        return $this->query;
    }
}
