<?php

declare(strict_types = 1);

namespace Example\App;

class Bag extends Container
{
    private ?string $category;

    public function __construct(string $category = null, array $items = [])
    {
        parent::__construct($items);
        $this->category = $category;
    }

    public function category(): ?string
    {
        return $this->category;
    }

    protected function capacity(): int
    {
        return 4;
    }
}
