<?php

declare(strict_types = 1);

namespace Example\App;

class ItemCategory
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public function equals(ItemCategory $other): bool
    {
        return $this->name === $other->name;
    }

    public static function CLOTHES(): self
    {
        return new self('clothes');
    }

    public static function METALS(): self
    {
        return new self('metals');
    }

    public static function WEAPONS(): self
    {
        return new self('weapons');
    }

    public static function HERBS(): self
    {
        return new self('herbs');
    }
}
