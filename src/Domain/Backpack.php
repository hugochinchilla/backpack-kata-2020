<?php

declare(strict_types = 1);

namespace Example\App\Domain;

use Example\App\Domain\Container;

class Backpack extends Container
{
    protected function capacity(): int
    {
        return 8;
    }
}
