<?php

declare(strict_types = 1);

namespace Example\App;

abstract class Container
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(string $string): void
    {
        if (count($this->items) < $this->capacity()) {
            $this->items[] = $string;
        }
    }

    public function items(): array
    {
        return $this->items;
    }

    abstract protected function capacity(): int;
}
