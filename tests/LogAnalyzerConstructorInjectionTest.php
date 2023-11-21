<?php

use ArtOfUnitTesting\IExtensionManager;
use ArtOfUnitTesting\LogAnalyzerConstructorInjection;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 * >>> Given_When_Then
 * >>> Arrange_Act_Assert
 * Needs @test annotation to work with PHPUnit.
 *
 * @group LogAnalyzerExtract
 */
class LogAnalyzerConstructorInjectionTest extends TestCase
{

    /**
     * @test
     */
    public function isValidLogFileName_NameSupportedExtension_ReturnsTrue() : void
    {
        // arrange
        $myFakeManager = $this->getFakeExtensionManager();
        $myFakeManager->willBeValid = true;

        // act
        $log = new LogAnalyzerConstructorInjection($myFakeManager);
        $result = $log->isValidLogFileName('short.ext');

        // assert
        $this->assertTrue($result);

    }

    protected function getFakeExtensionManager()
    {
        return new class implements IExtensionManager {

            public bool $willBeValid = true;

            public function isValid(string $fileName) : bool
            {
                return $this->willBeValid;
            }

        };
    }


}
