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

    public function sort(Carrier $durance): void
    {
        $this->dumpContainer($durance->backpack());
        foreach ($durance->bags() as $bag) {
            $this->dumpContainer($bag);
        }
        foreach ($durance->bags() as $bag) {
            $bag->setItems($this->getItemsForCategory($bag->category(), 4));
        }
        while ($item = array_shift($this->items)) {
            $durance->pickItem($item);
        }
    }

    public function dumpContainer(Container $container): void
    {
        foreach ($container->items() as $item) {
            $this->items[] = $item;
            $container->setItems([]);
        }
    }

    public function getItemsForCategory(ItemCategory $category, int $limit): array
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
}
