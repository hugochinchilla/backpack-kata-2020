<?php

declare(strict_types = 1);

namespace Example\App\Carrier;

use Example\App\Backpack;
use Example\App\Bag;

class Carrier
{
    private Backpack $backpack;
    private array $bags;

    public function __construct()
    {
        $this->backpack = new Backpack();
        $this->bags = [];
    }

    public function backpack(): Backpack
    {
        return $this->backpack;
    }

    public function bags(): array
    {
        return $this->bags;
    }

    public function addBag(Bag $bag): void
    {
        $this->bags[] = $bag;
    }
}
