<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class GetTasksRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'page' => ['sometimes', 'integer', 'min:1'],
            'sort' => ['sometimes', 'in:created_at,due_at'],
            'order' => ['sometimes', 'in:asc,desc'],
            'is_done' => ['sometimes', 'boolean'],
            'tag' => ['sometimes', 'string', 'max:50'],
            'q' => ['sometimes', 'string', 'max:200'],
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.max' => 'Max amount of elements per page - 50',
            'per_page.min' => 'Min amount of elements per page  - 1',
            'sort.in' => 'Sorting is only possible by created_at or due_at',
            'order.in' => 'Sort order can only be asc or desc',
        ];
    }
}
