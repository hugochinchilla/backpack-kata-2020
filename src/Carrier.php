<?php

declare(strict_types = 1);

namespace Example\App;

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

    public function pickItem(string $item)
    {
        try {
            $this->backpack->add($item);
        } catch (ContainerFullException $e) {
            if ($this->bags()) {
                $this->bags[0]->add($item);
            }
        }
    }
}
