<?php

declare(strict_types = 1);

namespace Example\App;

class Backpack
{
    const CAPACITY = 8;

    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function items(): array
    {
        return $this->items;
    }

    public function add(string $string): void
    {
        if (count($this->items) < self::CAPACITY) {
            $this->items[] = $string;
        }
    }
}
