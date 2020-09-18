<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Backpack;
use Example\App\Bag;

class ContainerFactory
{
    public function fullBackpack(): Backpack
    {
        $backpack = new Backpack();
        $backpack->add('item 1');
        $backpack->add('item 2');
        $backpack->add('item 3');
        $backpack->add('item 4');
        $backpack->add('item 5');
        $backpack->add('item 6');
        $backpack->add('item 7');
        $backpack->add('item 8');

        return $backpack;
    }

    public function fullBag(): Bag
    {
        $bag = new Bag(null);
        $bag->add('item 1');
        $bag->add('item 2');
        $bag->add('item 3');
        $bag->add('item 4');

        return $bag;
    }
}
