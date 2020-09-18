<?php

declare(strict_types = 1);

namespace Example\App;

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

    public function sort(Carrier $carrier): void
    {
        $this->dumpAllContents($carrier);
        $this->sortAllItems();
        $this->fillBagsWithItemsOfItsCategory($carrier);
        $this->putRemainingItemsAnywhere($carrier);
    }

    private function dumpAllContents(Carrier $durance): void
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

    private function fillBagsWithItemsOfItsCategory(Carrier $carrier): void
    {
        foreach ($carrier->bags() as $bag) {
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

    private function putRemainingItemsAnywhere(Carrier $carrier): void
    {
        while ($item = array_shift($this->items)) {
            $carrier->pickItem($item);
        }
    }
}
