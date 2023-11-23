<?php

use ArtOfUnitTesting\stubbing\IExtensionManager;
use ArtOfUnitTesting\stubbing\LogAnalyzerSimulateException;
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
 * @group LogAnalyzerSimulateException
 */
class LogAnalyzerSimulateExceptionTest extends TestCase
{

    #[Test]
    public function isValidLogFileName_ExtManagerThrowsException_ReturnsFalse() : void
    {
        // arrange
        $myFakeManager = $this->getFakeExtensionManager();
        $myFakeManager->willThrow = new \Exception('this is a fake');
        $log = new LogAnalyzerSimulateException($myFakeManager);

        // act
        $result = $log->isValidLogFileName('anything.myextension');

        // assert
        $this->assertFalse($result);

    }

    protected function getFakeExtensionManager() : IExtensionManager
    {
        return new class implements IExtensionManager {

            public bool $willBeValid = true;
            public \Exception $willThrow;

            public function isValid(string $fileName) : bool
            {
                if($this->willThrow) {
                    throw $this->willThrow;
                }
                return $this->willBeValid;
            }

        };
    }


}
