<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and licence information, please read the
 * LICENSE file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

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
