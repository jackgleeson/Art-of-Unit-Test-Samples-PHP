<?php

use ArtOfUnitTesting\stubbing\IExtensionManager;
use ArtOfUnitTesting\stubbing\LogAnalyzerConstructorInjection;
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
 * @group LogAnalyzerConstructorInjection
 */
class StubUsingConstructorInjectionTest extends TestCase
{

    #[Test]
    public function isValidLogFileName_NameSupportedExtension_ReturnsTrue() : void
    {
        // arrange
        $myFakeManager = $this->getFakeExtensionManager();
        $myFakeManager->willBeValid = true;
        $log = new LogAnalyzerConstructorInjection($myFakeManager);

        // act
        $result = $log->isValidLogFileName('short.ext');

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
