<?php

declare(strict_types = 1);

namespace Example\App\Domain;

use Example\App\Domain\ItemCategory;

class Item
{
    private string $name;
    private ItemCategory $category;

    public function __construct(string $name, ItemCategory $category)
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): ItemCategory
    {
        return $this->category;
    }
}
