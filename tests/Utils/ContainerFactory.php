<?php

declare(strict_types = 1);

namespace Example\Tests\Utils;

use Example\App\Domain\Backpack;
use Example\App\Domain\Bag;

class ContainerFactory
{
    private ItemFactory $items;

    public function __construct()
    {
        $this->items = new ItemFactory();
    }

    public function fullBackpack(): Backpack
    {
        $backpack = new Backpack();
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());
        $backpack->add($this->items->gold());

        return $backpack;
    }

    public function fullBag(): Bag
    {
        $bag = new Bag(null);
        $bag->add($this->items->gold());
        $bag->add($this->items->gold());
        $bag->add($this->items->gold());
        $bag->add($this->items->gold());

        return $bag;
    }
}
