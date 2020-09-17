<?php

declare(strict_types = 1);

namespace Example\App;

class Backpack extends Container
{
    protected function capacity(): int
    {
        return 8;
    }
}
