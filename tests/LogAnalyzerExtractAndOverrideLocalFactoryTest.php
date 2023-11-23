<?php

use ArtOfUnitTesting\IExtensionManager;
use ArtOfUnitTesting\LogAnalyzerExtractAndOverrideLocalFactory;
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
 * @group LogAnalyzerExtractAndOverrideLocalFactory
 */
class LogAnalyzerExtractAndOverrideLocalFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function isValidLogFileName_SupportedExtension_ReturnsTrue() : void
    {
        // arrange
        //// get stub and configure result
        $fakeExtensionManager = $this->getFakeExtensionManagerStub();
        $fakeExtensionManager->willBeValid = true;

        //// get testable log analyzer instance
        $testableLogAnalyzer = $this->getTestableLogAnalyzer($fakeExtensionManager);

        // act
        $result = $testableLogAnalyzer->isValidLogFileName('filename.ext');

        // assert
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function isValidLogFileName_UnsupportedExtension_ReturnsFalse() : void
    {
        // arrange
        //// get stub and configure result
        $fakeExtensionManager = $this->getFakeExtensionManagerStub();
        $fakeExtensionManager->willBeValid = false;

        //// get testable log analyzer instance
        $testableLogAnalyzer = $this->getTestableLogAnalyzer($fakeExtensionManager);

        // act
        $result = $testableLogAnalyzer->isValidLogFileName('file.unsupported');

        // assert
        $this->assertFalse($result);
    }


    /**
     * This is where we use extract and override to extend the class under test
     * and override the local factory method to return our stub
     *
     * @param \ArtOfUnitTesting\IExtensionManager $extensionManager
     *
     * @return \ArtOfUnitTesting\LogAnalyzerExtractAndOverrideLocalFactory
     */
    protected function getTestableLogAnalyzer(IExtensionManager $extensionManager
    ) : LogAnalyzerExtractAndOverrideLocalFactory {
        return new class($extensionManager) extends LogAnalyzerExtractAndOverrideLocalFactory {

            private IExtensionManager $extensionManager;

            public function __construct(IExtensionManager $extensionManager)
            {
                $this->extensionManager = $extensionManager;
            }

            /**
             * This method overrides the local factory method in the
             * class under test
             *
             * @return \ArtOfUnitTesting\IExtensionManager
             */
            protected function getExtensionManager() : IExtensionManager
            {
                return $this->extensionManager;
            }

        };
    }

    /**
     * This is our stub for the ExtensionManager class created
     * using an anonymous class to save having to add test classes to
     * the code base.
     */
    protected function getFakeExtensionManagerStub() : IExtensionManager
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
