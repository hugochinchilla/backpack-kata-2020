<?php

declare(strict_types = 1);

namespace Example\App\Domain;

use Example\App\Domain\Exception\ContainerFullException;

abstract class Container
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(Item $item): void
    {
        if (count($this->items) >= $this->capacity()) {
            throw new ContainerFullException('This container is full');
        }

        $this->items[] = $item;
    }

    // @return Item[]
    public function items(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    abstract protected function capacity(): int;
}
