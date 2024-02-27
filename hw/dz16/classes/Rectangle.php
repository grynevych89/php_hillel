<?php

class Rectangle extends Figure {
    private int|float $length;
    private int|float $width;

    public function __construct(int|float $length, int|float $width)
    {
        if ($length <= 0 || $width <= 0) {
            throw new Exception('Length and width must be positive numbers.');
        }
        $this->length = $length;
        $this->width = $width;
    }

    public function area(): int|float
    {
        return $this->length * $this->width;
    }

    public function perimeter(): int|float
    {
        return 2 * ($this->length + $this->width);
    }
}