<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Backpack;
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

        for ($i = 0; $i < 10; ++$i) {
            $backpack->add("item $i");
        }

        $this->assertEquals(
            [
                'item 0',
                'item 1',
                'item 2',
                'item 3',
                'item 4',
                'item 5',
                'item 6',
                'item 7',
            ],
            $backpack->items()
        );
    }
}
