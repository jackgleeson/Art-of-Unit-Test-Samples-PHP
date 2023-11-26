<?php

use ArtOfUnitTesting\misc\MemCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MemCalculatorTest extends TestCase
{

    #[Test]
    public function Sum_ByDefault_ReturnsZero() : void
    {
        $calc = self::makeCalc();
        $lastSum = $calc->sum();
        $this->assertEquals(0, $lastSum);

    }

    #[Test]
    public function Add_WhenCalled_ChangesSum() : void
    {
        $calc = self::makeCalc();
        $calc->add(1);
        $lastSum = $calc->sum();
        $this->assertEquals(1, $lastSum);
    }

    private static function makeCalc() : MemCalculator
    {
        return new MemCalculator();
    }

}
