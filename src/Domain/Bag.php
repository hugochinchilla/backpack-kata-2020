<?php

declare(strict_types = 1);

namespace Example\App\Domain;

class Bag extends Container
{
    private ?ItemCategory $category;

    public function __construct(ItemCategory $category = null)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function category(): ?ItemCategory
    {
        return $this->category;
    }

    protected function capacity(): int
    {
        return 4;
    }
}
