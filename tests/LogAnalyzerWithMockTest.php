<?php

use ArtOfUnitTesting\manualMocking\MockWebService;
use ArtOfUnitTesting\manualMocking\LogAnalyzerWithMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 *
 */
class LogAnalyzerWithMockTest extends TestCase
{

    #[Test]
    public function Analyze_TooShortFileName_CallsWebService() : void
    {
        // arrange
        $mockService = new MockWebService();
        $logAnalyzer = new LogAnalyzerWithMock($mockService);
        $tooShortFileName = "abc.ext";

        // act
        $logAnalyzer->analyze($tooShortFileName);

        // assert
        $expectedError = "File name too short: " . $tooShortFileName;
        $this->assertEquals($expectedError, $mockService->lastError);
        // Note: the call to $mockService->lastError only works because
        // objects are passed by reference in PHP.
    }

}
