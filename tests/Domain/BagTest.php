<?php

declare(strict_types = 1);

namespace Example\Tests\Domain;

use Example\App\Domain\Bag;
use Example\App\Domain\Exception\ContainerFullException;
use Example\App\Domain\ItemCategory;
use Example\Tests\Utils\ContainerFactory;
use Example\Tests\Utils\ItemFactory;
use PHPStan\Testing\TestCase;

class BagTest extends TestCase
{
    /** @test */
    public function a_new_bag_is_empty(): void
    {
        $bag = new Bag();

        $this->assertEquals([], $bag->items());
    }

    /** @test */
    public function a_bag_can_have_a_category(): void
    {
        $bag = new Bag(ItemCategory::HERBS());

        $this->assertInstanceOf(ItemCategory::class, $bag->category());
        $this->assertTrue($bag->category()->equals(ItemCategory::HERBS()));
    }

    /** @test */
    public function can_add_an_item_to_the_bag(): void
    {
        $bag = new Bag();
        $wool = (new ItemFactory())->wool();

        $bag->add($wool);

        $this->assertEquals([$wool], $bag->items());
    }

    /** @test */
    public function a_bag_can_hold_up_to_4_items(): void
    {
        $fullBag = (new ContainerFactory())->fullBag();

        $this->expectException(ContainerFullException::class);

        $fullBag->add((new ItemFactory())->cherryBlossom());
    }

    /** @test */
    public function a_bag_with_category_can_hold_items_of_any_kind(): void
    {
        $metalBag = new Bag(ItemCategory::METALS());
        $herb = (new ItemFactory())->cherryBlossom();

        $metalBag->add($herb);

        $this->assertInstanceOf(ItemCategory::class, $metalBag->category());
        $this->assertFalse($herb->category()->equals($metalBag->category()));
    }
}
