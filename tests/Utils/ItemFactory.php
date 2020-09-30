<?php

declare(strict_types = 1);

namespace Example\Tests\Utils;

use Example\App\Domain\Item;
use Example\App\Domain\ItemCategory;

class ItemFactory
{
    public function leather(): Item
    {
        return new Item('leather', ItemCategory::CLOTHES());
    }

    public function linen(): Item
    {
        return new Item('linen', ItemCategory::CLOTHES());
    }

    public function silk(): Item
    {
        return new Item('silk', ItemCategory::CLOTHES());
    }

    public function wool(): Item
    {
        return new Item('wool', ItemCategory::CLOTHES());
    }

    public function copper(): Item
    {
        return new Item('copper', ItemCategory::METALS());
    }

    public function gold(): Item
    {
        return new Item('gold', ItemCategory::METALS());
    }

    public function iron(): Item
    {
        return new Item('iron', ItemCategory::METALS());
    }

    public function silver(): Item
    {
        return new Item('silver', ItemCategory::METALS());
    }

    public function axe(): Item
    {
        return new Item('axe', ItemCategory::WEAPONS());
    }

    public function dagger(): Item
    {
        return new Item('dagger', ItemCategory::WEAPONS());
    }

    public function mace(): Item
    {
        return new Item('mace', ItemCategory::WEAPONS());
    }

    public function sword(): Item
    {
        return new Item('sword', ItemCategory::WEAPONS());
    }

    public function cherryBlossom(): Item
    {
        return new Item('cherry blossom', ItemCategory::HERBS());
    }

    public function marigold(): Item
    {
        return new Item('marigold', ItemCategory::HERBS());
    }

    public function rose(): Item
    {
        return new Item('rose', ItemCategory::HERBS());
    }

    public function seaweed(): Item
    {
        return new Item('seaweed', ItemCategory::HERBS());
    }
}
