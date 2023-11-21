<?php

namespace ArtOfUnitTesting;

class MemCalculator
{
    protected int $sum = 0;

    public function __construct()
    {
    }

    public function sum() : int
    {
        return $this->sum;
    }

    public function add(int $int) : void
    {
        $this->sum += $int;
    }

}