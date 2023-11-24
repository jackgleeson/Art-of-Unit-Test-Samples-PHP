<?php

use ArtOfUnitTesting\stubbing\LogAnalyzerExtractAndOverrideDirectResult;
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
class StubUsingExtractAndOverrideDirectResultTest extends TestCase
{

    #[Test]
    public function isValidLogFileName_SupportedExtension_ReturnsTrue() : void
    {
        // arrange
        $testableLogAnalyzer = $this->getTestableLogAnalyzer();
        $testableLogAnalyzer::$isSupported = true;

        // act
        $result = $testableLogAnalyzer->isValidLogFileName('filename.ext');

        // assert
        $this->assertTrue($result);
    }


    /**
     * This is where we use extract and override to extend the class under test
     * and override the direct result method. This easier than overriding a local
     * factory as we go straight to the result.
     *
     * @param \ArtOfUnitTesting\stubbing\IExtensionManager $extensionManager
     *
     * @return \ArtOfUnitTesting\stubbing\LogAnalyzerExtractAndOverrideLocalFactory
     */
    protected function getTestableLogAnalyzer() : LogAnalyzerExtractAndOverrideDirectResult {
        return new class extends LogAnalyzerExtractAndOverrideDirectResult {

            public static bool $isSupported = false;

            /**
             * This method overrides the result method directly in the
             * class under test
             */
            protected function isValid( string $fileName) : bool
            {
                return self::$isSupported;
            }

        };
    }


}
