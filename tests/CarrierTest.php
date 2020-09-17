<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\Bag;
use Example\App\Carrier\Carrier;
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
}
