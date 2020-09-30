<?php

declare(strict_types = 1);

namespace Example\App\Domain;

class Backpack extends Container
{
    protected function capacity(): int
    {
        return 8;
    }
}
