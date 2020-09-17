<?php

declare(strict_types = 1);

namespace Example\Tests;

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
}
