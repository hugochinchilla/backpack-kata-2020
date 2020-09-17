<?php

declare(strict_types = 1);

namespace Example\App\Carrier;

use Example\App\Backpack;

class Carrier
{
    private Backpack $backpack;

    public function __construct()
    {
        $this->backpack = new Backpack();
    }

    public function backpack(): Backpack
    {
        return $this->backpack;
    }
}
