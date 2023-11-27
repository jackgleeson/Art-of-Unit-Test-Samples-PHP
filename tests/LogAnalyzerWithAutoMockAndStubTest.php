<?php

use ArtOfUnitTesting\isolationFrameworks\FakeLogger;
use ArtOfUnitTesting\isolationFrameworks\IFileNameRules;
use ArtOfUnitTesting\isolationFrameworks\ILogger;
use ArtOfUnitTesting\isolationFrameworks\IWebService;
use ArtOfUnitTesting\isolationFrameworks\LogAnalyzerWithMock;
use ArtOfUnitTesting\isolationFrameworks\LogAnalyzerWithMockAndStub;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 *
 */
class LogAnalyzerWithAutoMockAndStubTest extends TestCase
{

    #[Test]
    public function Analyze_LoggerThrows_CallsWebService() : void
    {
        // arrange
        $mockWebService = $this->createMock(IWebService::class);
        $stubLogger = $this->createStub(ILogger::class);

        // expectations
        $stubLogger->method("logError")
            ->willThrowException(new \Exception("fake exception"));

        $mockWebService->expects($this->once())
            ->method("write")
            ->with($this->equalTo("Error from logger: fake exception"));

        // act
        $logAnalyzer = new LogAnalyzerWithMockAndStub($stubLogger, $mockWebService);
        $logAnalyzer->setMinNameLength(10);
        $logAnalyzer->analyze("short.txt");
    }

    #[Test]
    public function Mock_AnyArg_ThrowsException () : void
    {
        // arrange
        $mockFileNameRules = $this->createMock(IFileNameRules::class);

        // expectation
        $this->expectException(\Exception::class);
        $mockFileNameRules->expects($this->once())
            ->method("IsValidLogFileName")
            ->with($this->anything())
            ->willThrowException(new \Exception("fake exception"));

        // act
        $mockFileNameRules->isValidLogFileName("strict.txt");
    }
    #[Test]
    public function Mock_ByDefault_WorksForAnyString() : void
    {
        // arrange
        $mockFileNameRules = $this->createMock(IFileNameRules::class);

        // expectation
        $mockFileNameRules->expects($this->once())
            ->method("IsValidLogFileName")
            ->with($this->isType("string"))
            ->willReturn(true);

        // act (testing the mock directly)
        $this->assertTrue($mockFileNameRules->isValidLogFileName("strict.txt"));

    }
    #[Test]
    public function Mock_ByDefault_WorksForHardCodedArgument() : void
    {
        // arrange
        $mockFileNameRules = $this->createMock(IFileNameRules::class);

        // expectation
        $mockFileNameRules->expects($this->once())
            ->method("IsValidLogFileName")
            ->with("strict.txt")
            ->willReturn(true);

        // act (testing the mock directly)
        $this->assertTrue($mockFileNameRules->isValidLogFileName("strict.txt"));

    }

    #[Test]
    public function AutoMock_Analyze_TooShortFileName_CallsWebService() : void
    {
        // arrange
        $mockLogger = $this->createMock(ILogger::class);

        // expectation/assert ... in the middle :(
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
