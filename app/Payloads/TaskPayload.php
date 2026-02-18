<?php

declare(strict_types=1);

namespace App\Payloads;

use Carbon\CarbonInterface;

final readonly class TaskPayload
{
    public function __construct(
        public string $title,
        public bool $is_done,
        public ?CarbonInterface $due_at,
        /** @var string[] $tags */
        public array $tags,
    ) {}

    /**
     * @param array{
     * title: string,
     * is_done: bool,
     * due_at: ?CarbonInterface,
     * tags: string[]
     * } $attr
     */
    public static function fromArray(array $attr): self
    {
        return new self(
            title: $attr['title'],
            is_done: $attr['is_done'],
            due_at: $attr['due_at'],
            tags: $attr['tags']
        );
    }

    /**
     * @return array{due_at: ?CarbonInterface, is_done: bool, title: string}
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'is_done' => $this->is_done,
            'due_at' => $this->due_at,
        ];
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
