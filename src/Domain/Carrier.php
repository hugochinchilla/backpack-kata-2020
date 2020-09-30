<?php

declare(strict_types = 1);

namespace Example\App\Domain;

use Example\App\Domain\Exception\AllContainersFullException;
use Example\App\Domain\Exception\ContainerFullException;
use Example\App\Domain\Backpack;
use Example\App\Domain\Bag;
use Example\App\Domain\Exception\MaxBagsReachedException;
use Example\App\Domain\Item;

class Carrier
{
    private const MAX_BAGS = 4;

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
        if (count($this->bags) >= self::MAX_BAGS) {
            throw new MaxBagsReachedException("You can't have more bags");
        }

        $this->bags[] = $bag;
    }

    public function pickItem(Item $item): void
    {
        try {
            $this->backpack->add($item);
        } catch (ContainerFullException $e) {
            $this->storeInNextAvailableBag($item);
        }
    }

    private function storeInNextAvailableBag(Item $item): void
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
