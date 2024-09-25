<?php

declare(strict_types=1);

namespace Unit\Void;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

final class VoidTest extends UnitTestCase
{
    /**
     * Test to demonstrate that the TYPO3 Testing Framework
     * runs 3 assertions in the tearDown method.
     */
    #[Test]
    public function void001(): void
    {
        self::assertSame(1, 1);
    }

    /**
     * Another test which ascertains that each test method
     * calls the setUp and tearDown methods, because after this
     * method we see 8 assertions in the result.
     */
    #[Test]
    public function void002(): void
    {
        self::assertSame(1, 1);
    }
}
