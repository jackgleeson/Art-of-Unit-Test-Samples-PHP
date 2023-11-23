<?php

use ArtOfUnitTesting\ExtensionManagerFactory;
use ArtOfUnitTesting\IExtensionManager;
use ArtOfUnitTesting\LogAnalyzerFactoryClassInjection;
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
 * @group LogAnalyzerFactoryClass
 */
class LogAnalyzerFactoryClassInjectionTest extends TestCase
{

    /**
     * @test
     */
    public function isValidLogFileName_SupportedExtension_ReturnsTrue() : void
    {
        // arrange
        $myFakeManager = $this->getFakeExtensionManager();
        $myFakeManager->willBeValid = true;

        ExtensionManagerFactory::setExtensionManager($myFakeManager);
        $logAnalyzer = new LogAnalyzerFactoryClassInjection();

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
