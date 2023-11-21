<?php

use ArtOfUnitTesting\MemCalculator;
use PHPUnit\Framework\TestCase;

class MemCalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function Sum_ByDefault_ReturnsZero() : void
    {
        $calc = self::makeCalc();
        $lastSum = $calc->sum();
        $this->assertEquals(0, $lastSum);

    }

    /**
     * @test
     */
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
