<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Bag;
use Example\App\Carrier;
use Example\App\ItemCategory;
use Example\App\SortingSpell;
use PHPStan\Testing\TestCase;

class SortingSpellTest extends TestCase
{
    private ItemFactory $items;
    private SortingSpell $spell;

    public function setUp(): void
    {
        parent::setUp();
        $this->items = new ItemFactory();
        $this->spell = new SortingSpell();
    }

    /** @test */
    public function moves_objects_from_backpack_to_bag_with_item_category(): void
    {
        $herbsBag = new Bag(ItemCategory::HERBS());
        $metalBag = new Bag(ItemCategory::METALS());
        $iron = $this->items->iron();
        $durance = new Carrier();
        $durance->addBag($herbsBag);
        $durance->addBag($metalBag);
        $durance->pickItem($iron);

        $this->spell->sort($durance);

        $this->assertEmpty($durance->backpack()->items());
        $this->assertEmpty($herbsBag->items());
        $this->assertEquals([$iron], $metalBag->items());
    }

    /** @test */
    public function items_that_not_belong_to_a_bag_are_kept_in_the_backpack(): void
    {
        $herbsBag = new Bag(ItemCategory::HERBS());
        $iron = $this->items->iron();
        $durance = new Carrier();
        $durance->addBag($herbsBag);
        $durance->pickItem($iron);

        $this->spell->sort($durance);

        $this->assertEmpty($herbsBag->items());
        $this->assertEquals([$iron], $durance->backpack()->items());
    }
}
