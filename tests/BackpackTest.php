<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Backpack;
use Example\App\ContainerFullException;
use PHPUnit\Framework\TestCase;

class BackpackTest extends TestCase
{
    /** @test */
    public function a_new_backpack_is_empty(): void
    {
        $backpack = new Backpack();

        $this->assertEquals([], $backpack->items());
    }

    /** @test */
    public function can_add_an_item_to_the_backpack(): void
    {
        $backpack = new Backpack();

        $backpack->add('wool');

        $this->assertEquals(['wool'], $backpack->items());
    }

    /** @test */
    public function a_backpack_can_hold_up_to_8_items(): void
    {
        $backpack = new Backpack();
        $backpack->add("item 1");
        $backpack->add("item 2");
        $backpack->add("item 3");
        $backpack->add("item 4");
        $backpack->add("item 5");
        $backpack->add("item 6");
        $backpack->add("item 7");
        $backpack->add("item 8");

        $this->expectException(ContainerFullException::class);

        $backpack->add("item 9");
    }
}
