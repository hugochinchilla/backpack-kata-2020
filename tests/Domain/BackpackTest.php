<?php

declare(strict_types = 1);

namespace Example\Tests\Domain;

use Example\App\Domain\Backpack;
use Example\App\Domain\Exception\ContainerFullException;
use Example\Tests\Utils\ContainerFactory;
use Example\Tests\Utils\ItemFactory;
use PHPUnit\Framework\TestCase;

class BackpackTest extends TestCase
{
    private ItemFactory $items;

    public function setUp(): void
    {
        $this->items = new ItemFactory();
    }

    /** @test */
    public function a_new_backpack_is_empty(): void
    {
        $backpack = new Backpack();

        $this->assertEquals([], $backpack->items());
    }

    /** @test */
    public function can_add_an_item_to_the_backpack(): void
    {
        $wool = $this->items->wool();
        $backpack = new Backpack();

        $backpack->add($wool);

        $this->assertEquals([$wool], $backpack->items());
    }

    /** @test */
    public function a_backpack_can_hold_up_to_8_items(): void
    {
        $backpack = (new ContainerFactory())->fullBackpack();

        $this->expectException(ContainerFullException::class);

        $backpack->add($this->items->gold());
    }
}
