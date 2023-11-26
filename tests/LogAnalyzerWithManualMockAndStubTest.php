<?php

use ArtOfUnitTesting\manualMocking\MockEmailService;
use ArtOfUnitTesting\manualMocking\FakeWebService;
use ArtOfUnitTesting\manualMocking\LogAnalyzerWithMockAndStub;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Test code for book, The Art Of Unit Testing.
 *
 * Test naming convention from p26:
 * >>> [UnitOfWorkName]_[ScenarioUnderTest]_[ExpectedResult]
 *
 */
class LogAnalyzerWithManualMockAndStubTest extends TestCase
{

    #[Test]
    public function Analyze_WebServiceThrows_SendsEmail() : void
    {
        // arrange
        $stubWebService = new FakeWebService();
        $stubWebService->toThrow = new \Exception("fake exception email body");
        $mockEmailService = new MockEmailService();
        $logAnalyzer = new LogAnalyzerWithMockAndStub($stubWebService, $mockEmailService);
        $tooShortFileName = "abc.ext";

        // act
        $logAnalyzer->analyze($tooShortFileName);

        // assert
        $this->assertEquals("someone@somewhere.com", $mockEmailService->to);
        $this->assertEquals("Can't log!!!", $mockEmailService->subject);
        $this->assertEquals("fake exception email body", $mockEmailService->body);

    }

}
