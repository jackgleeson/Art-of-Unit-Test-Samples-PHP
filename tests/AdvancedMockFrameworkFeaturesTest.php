<?php

use ArtOfUnitTesting\isolationFrameworks\ICache;
use ArtOfUnitTesting\isolationFrameworks\ILogger;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AdvancedMockFrameworkFeaturesTest extends TestCase
{

    #[Test]
    public function Mock_WithoutArgumentsExpectation_IsValid() : void
    {
        $mockLogger = $this->createMock(ILogger::class);

        $mockLogger->expects($this->once())->method('logError');

        $mockLogger->logError('error message');
    }

    public function Mock_RecursiveCall_IsValid() : void
    {
        $mockCache = $this->createMock(ICache::class);
        $this->assertInstanceOf(ICache::class, $mockCache->getCacheInstance()->getCacheInstance()->getCacheInstance());
    }

}
