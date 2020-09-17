<?php

declare(strict_types = 1);

namespace Example\Tests;

use Example\App\HelloWorld;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    /** @test */
    public function says_hello(): void
    {
        $instance = new HelloWorld();

        $result = $instance->greet();

        $this->assertEquals('Hello world', $result);
    }
}
