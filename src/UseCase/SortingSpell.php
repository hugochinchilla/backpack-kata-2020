<?php

declare(strict_types = 1);

namespace Example\App\UseCase;

use Example\App\Domain\Container;
use Example\App\Domain\Item;
use Example\App\Domain\ItemCategory;
use Example\App\Domain\Player;

class SortingSpell
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function sort(Player $player): void
    {
        $this->dumpAllContents($player);
        $this->sortAllItems();
        $this->fillBagsWithItemsOfItsCategory($player);
        $this->putRemainingItemsAnywhere($player);
    }

    private function dumpAllContents(Player $durance): void
    {
        $this->dumpContainer($durance->backpack());
        foreach ($durance->bags() as $bag) {
            $this->dumpContainer($bag);
        }
    }

    private function dumpContainer(Container $container): void
    {
        foreach ($container->items() as $item) {
            $this->items[] = $item;
            $container->setItems([]);
        }
    }

    private function sortAllItems(): void
    {
        usort($this->items, fn ($a, $b) => $a->name() <=> $b->name());
    }

    private function fillBagsWithItemsOfItsCategory(Player $player): void
    {
        foreach ($player->bags() as $bag) {
            $bag->setItems($this->getItemsForCategory($bag->category(), 4));
        }
    }

    private function getItemsForCategory(ItemCategory $category, int $limit): array
    {
        $itemsOfCategory = [];
        $otherItems = [];

        foreach ($this->items as $item) {
            if ($item->category()->equals($category) && count($itemsOfCategory) <= $limit) {
                $itemsOfCategory[] = $item;
            } else {
                $otherItems[] = $item;
            }
        }

        $this->items = $otherItems;

        return $itemsOfCategory;
    }

    private function putRemainingItemsAnywhere(Player $player): void
    {
        while ($item = array_shift($this->items)) {
            $player->pickItem($item);
        }
    }
}
