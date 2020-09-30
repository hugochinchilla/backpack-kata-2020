<?php

declare(strict_types = 1);

namespace Example\Tests\UseCase;

use Example\App\Domain\Bag;
use Example\App\Domain\ItemCategory;
use Example\App\Domain\Player;
use Example\App\UseCase\SortingSpell;
use Example\Tests\Utils\ItemFactory;
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
        $durance = new Player();
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
        $durance = new Player();
        $durance->addBag($herbsBag);
        $durance->pickItem($iron);

        $this->spell->sort($durance);

        $this->assertEmpty($herbsBag->items());
        $this->assertEquals([$iron], $durance->backpack()->items());
    }

    /** @test */
    public function moved_objects_are_sorted_alphabetically(): void
    {
        $gold = $this->items->gold();
        $copper = $this->items->copper();
        $wool = $this->items->wool();
        $axe = $this->items->axe();
        $metalBag = new Bag(ItemCategory::METALS());
        $durance = new Player();
        $durance->addBag($metalBag);
        $durance->pickItem($gold);
        $durance->pickItem($copper);
        $durance->pickItem($wool);
        $durance->pickItem($axe);

        $this->spell->sort($durance);

        $this->assertEquals([$copper, $gold], $metalBag->items());
        $this->assertEquals([$axe, $wool], $durance->backpack()->items());
    }
}
