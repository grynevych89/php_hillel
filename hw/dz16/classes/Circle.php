<?php

class Circle extends Figure
{
    private int|float $radius;

    public function __construct(int|float $radius)
    {
        if ($radius <= 0) {
            throw new Exception('Radius must be a positive number.');
        }
        $this->radius = $radius;
    }

    public function area(): int|float
    {
        return pi() * ($this->radius ** 2);
    }

    public function perimeter(): int|float
    {
        return 2 * pi() * $this->radius;
    }
}