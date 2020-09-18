<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Bag;
use Example\App\Carrier;
use PHPStan\Testing\TestCase;

class CarrierTest extends TestCase
{
    /** @test */
    public function a_carrier_starts_with_an_empty_backpack(): void
    {
        $durance = new Carrier();

        $this->assertEmpty($durance->backpack()->items());
    }

    /** @test */
    public function a_carrier_can_have_a_bag(): void
    {
        $durance = new Carrier();
        $a_bag = new Bag();

        $durance->addBag($a_bag);

        $this->assertEquals([$a_bag], $durance->bags());
    }

    public function a_carrier_can_have_up_to_4_bags(): void
    {
        $durance = new Carrier();

        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());
        $durance->addBag(new Bag());

        $this->assertEquals(4, count($durance->bags()));
    }

    /** @test */
    public function a_carrier_can_pick_things_from_the_ground_and_put_them_in_the_backpack(): void
    {
        $durance = new Carrier();
        $durance->pickItem('axe');

        $this->assertEquals(['axe'], $durance->backpack()->items());
    }

    /** @test */
    public function when_the_backpack_is_full_items_are_stored_in_the_next_empty_bag(): void
    {
        $a_bag = new Bag();
        $durance = new Carrier();
        $durance->addBag($a_bag);

        $durance->pickItem('item 1');
        $durance->pickItem('item 2');
        $durance->pickItem('item 3');
        $durance->pickItem('item 4');
        $durance->pickItem('item 5');
        $durance->pickItem('item 6');
        $durance->pickItem('item 7');
        $durance->pickItem('item 8');
        $durance->pickItem('this goes to a bag');

        $this->assertEquals(['this goes to a bag'], $a_bag->items());
    }

    /** @test */
    public function when_a_bag_is_full_uses_the_next_one_with_capacity(): void
    {
        $full_bag = new Bag(null, ['item 1', 'item 2', 'item 3', 'item 4']);
        $empty_bag = new Bag();
        $durance = new Carrier();
        $durance->addBag($full_bag);
        $durance->addBag($empty_bag);
        $durance->pickItem('item 1');
        $durance->pickItem('item 2');
        $durance->pickItem('item 3');
        $durance->pickItem('item 4');
        $durance->pickItem('item 5');
        $durance->pickItem('item 6');
        $durance->pickItem('item 7');
        $durance->pickItem('item 8');

        $durance->pickItem('heavy item');

        $this->assertEquals(['heavy item'], $empty_bag->items());
    }
}
