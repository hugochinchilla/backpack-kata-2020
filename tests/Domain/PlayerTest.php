<?php

declare(strict_types = 1);

namespace Example\Tests\Domain;

use Example\App\Domain\Bag;
use Example\App\Domain\Exception\AllContainersFullException;
use Example\App\Domain\Exception\MaxBagsReachedException;
use Example\App\Domain\Player;
use Example\Tests\Utils\ContainerFactory;
use Example\Tests\Utils\ItemFactory;
use PHPStan\Testing\TestCase;

class PlayerTest extends TestCase
{
    private ContainerFactory $container;
    private ItemFactory $items;

    public function setUp(): void
    {
        $this->container = new ContainerFactory();
        $this->items = new ItemFactory();
    }

    /** @test */
    public function durance_starts_with_an_empty_backpack(): void
    {
        $durance = new Player();

        $this->assertEmpty($durance->backpack()->items());
    }

    /** @test */
    public function durance_can_have_a_bag(): void
    {
        $durance = new Player();
        $a_bag = new Bag();

        $durance->addBag($a_bag);

        $this->assertEquals([$a_bag], $durance->bags());
    }

    /** @test */
    public function durance_can_have_up_to_4_bags(): void
    {
        $this->expectException(MaxBagsReachedException::class);

        $durance = new Player();

        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
    }

    /** @test */
    public function durance_can_pick_things_from_the_ground_and_put_them_in_the_backpack(): void
    {
        $anAxe = $this->items->axe();
        $durance = new Player();
        $durance->pickItem($anAxe);

        $this->assertEquals([$anAxe], $durance->backpack()->items());
    }

    /** @test */
    public function when_the_backpack_is_full_items_are_stored_in_the_next_empty_bag(): void
    {
        $factory = new ContainerFactory();
        $a_bag = new Bag();
        $durance = new Player();
        $durance->setBackpack($factory->fullBackpack());
        $durance->addBag($a_bag);
        $aMace = $this->items->mace();

        $durance->pickItem($aMace);

        $this->assertEquals([$aMace], $a_bag->items());
    }

    /** @test */
    public function when_a_bag_is_full_uses_the_next_one_with_capacity(): void
    {
        $factory = new ContainerFactory();
        $empty_bag = new Bag();
        $durance = new Player();
        $iron = $this->items->iron();
        $durance->setBackpack($factory->fullBackpack());
        $durance->addBag($factory->fullBag());
        $durance->addBag($empty_bag);

        $durance->pickItem($iron);

        $this->assertEquals([$iron], $empty_bag->items());
    }

    /** @test */
    public function can_not_pick_an_item_if_the_backpack_and_all_bags_are_full(): void
    {
        $factory = new ContainerFactory();
        $durance = new Player();
        $durance->setBackpack($factory->fullBackpack());
        $durance->addBag($factory->fullBag());

        $this->expectException(AllContainersFullException::class);

        $durance->pickItem($this->items->iron());
    }
}
