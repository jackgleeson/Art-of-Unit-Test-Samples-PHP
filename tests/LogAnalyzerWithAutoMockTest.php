<?php

use ArtOfUnitTesting\isolationFrameworks\FakeLogger;
use ArtOfUnitTesting\isolationFrameworks\ILogger;
use ArtOfUnitTesting\isolationFrameworks\LogAnalyzerWithMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 *
 */
class LogAnalyzerWithAutoMockTest extends TestCase
{

    #[Test]
    public function AutoMock_Analyze_TooShortFileName_CallsWebService() : void
    {
        // arrange
        $mockLogger = $this->createMock(ILogger::class);

        // assert ... in the middle :(
        $mockLogger->expects($this->once())
            ->method('logError')
            ->with("File name too short: abc.ext");

        $logAnalyzer = new LogAnalyzerWithMock($mockLogger);

        // act
        $logAnalyzer->analyze("abc.ext");

   }

    #[Test]
    public function ManualMock_Analyze_TooShortFileName_CallsWebService() : void
    {
        // arrange
        $mockLogger = new FakeLogger();
        $logAnalyzer = new LogAnalyzerWithMock($mockLogger);
        $tooShortFileName = "abc.ext";

        // act
        $logAnalyzer->analyze($tooShortFileName);

        // assert
        $expectedError = "File name too short: " . $tooShortFileName;
        $this->assertEquals($expectedError, $mockLogger->lastError);
        // Note: the call to $mockService->lastError only works because
        // objects are passed by reference in PHP.
    }

}
