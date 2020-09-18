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

    public function pickItem(string $item): void
    {
        try {
            $this->backpack->add($item);
        } catch (ContainerFullException $e) {
            $this->storeInNextAvailableBag($item);
        }
    }

    private function storeInNextAvailableBag(string $item): void
    {
        foreach ($this->bags as $bag) {
            try {
                $bag->add($item);

                return;
            } catch (ContainerFullException $e) {
            }
        }

        throw new AllContainersFullException("You can't pick more items");
    }

    public function setBackpack(Backpack $backpack): void
    {
        $this->backpack = $backpack;
    }
}
