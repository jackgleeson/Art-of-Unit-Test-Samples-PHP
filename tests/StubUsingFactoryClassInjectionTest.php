<?php

use ArtOfUnitTesting\stubbing\ExtensionManagerFactory;
use ArtOfUnitTesting\stubbing\IExtensionManager;
use ArtOfUnitTesting\stubbing\LogAnalyzerFactoryClassInjection;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 * >>> Given_When_Then
 * >>> Arrange_Act_Assert
 *
 */
class StubUsingFactoryClassInjectionTest extends TestCase
{

    #[Test]
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
