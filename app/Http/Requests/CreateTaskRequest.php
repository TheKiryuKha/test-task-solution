<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Payloads\TaskPayload;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class CreateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:200', 'string'],
            'is_done' => ['sometimes', 'boolean'],
            'due_at' => ['sometimes', 'date'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['sometimes', 'string', 'max:50'],
        ];
    }

    public function payload(): TaskPayload
    {
        /** @var string[] $tags */
        $tags = $this->array('tags');

        return TaskPayload::fromArray([
            'title' => $this->string('title')->value(),
            'is_done' => $this->boolean('is_done'),
            'due_at' => $this->date('due_at') ?? null,
            'tags' => $tags,
        ]);
    }
}
