<?php

use ArtOfUnitTesting\misc\LogAnalyzerNoStub;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 *
 */
class LogAnalyzerNoStubTest extends TestCase
{

    private LogAnalyzerNoStub $logAnalyzer;

    public function setUp() : void
    {
        parent::setUp();
        $this->logAnalyzer = new LogAnalyzerNoStub();
    }


    #[Test]
    #[DataProvider('getLogFileName')]
    public function isValidLogFileName_VariousExtensions_ChecksThem(string $fileName, bool $expectedResult) : void
    {
        $this->assertEquals($expectedResult, $this->logAnalyzer->isValidLogFileName($fileName));
    }

    #[Test]
    public function isValidLogFileName_EmptyFileName_ThrowsException() : void
    {
        // using expectExceptionMessageMatches as a substitute for Contains
        $this->expectExceptionMessageMatches("/filename has to be provided/");
        $this->expectException(\InvalidArgumentException::class);

        $this->logAnalyzer->isValidLogFileName('');
    }

    #[Test]
    public function isValidLogFileName_WhenCalled_ChecksWasLastFileNameValid() : void
    {
        $this->logAnalyzer->isValidLogFileName('fileWithBadExtension.foo');
        $this->assertFalse($this->logAnalyzer->wasLastFileNameValid);
    }

    public static function getLogFileName() : array
    {
        return [
            ['fileWithGoodExtension.log', true],
            ['fileWithGoodExtension.LOG', true],
            ['fileWithBadExtension.foo', false],
        ];
    }

    public function tearDown() : void
    {
        parent::tearDown();
        // not needed or possible due to type in PHP
        // $this->logAnalyzer = null;
    }


}
