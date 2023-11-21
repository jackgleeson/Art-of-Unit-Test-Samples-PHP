<?php

use ArtOfUnitTesting\IExtensionManager;
use ArtOfUnitTesting\LogAnalyzerConstructorInjection;
use ArtOfUnitTesting\LogAnalyzerPropertyInjection;
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
 * @group LogAnalyzerConstructorInjection
 */
class LogAnalyzerPropertyInjectionTest extends TestCase
{

    /**
     * @test
     */
    public function isValidLogFileName_SupportedExtenion_ReturnsTrue() : void
    {
        // arrange
        $myFakeManager = $this->getFakeExtensionManager();
        $myFakeManager->willBeValid = true;
        $logAnalyzer = new LogAnalyzerPropertyInjection();
        $logAnalyzer->setManager($myFakeManager);

        // act
        $result = $logAnalyzer->isValidLogFileName('short.ext');

        // assert
        $this->assertTrue($result);
    }

    protected function getFakeExtensionManager() : IExtensionManager
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
