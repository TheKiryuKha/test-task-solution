<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Task $resource
 */
final class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'is_done' => $this->resource->is_done,
            'due_at' => $this->resource->due_at,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'tags' => TagResource::collection($this->resource->tags),
        ];
    }
}
