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

namespace Unit\Service\CustomDate;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Service\CustomDate\CustomDatePrinter;
use Workshop\Theme\Service\CustomDate\DateProviderInterface;

final class CustomDatePrinterTest extends UnitTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function printDate(): void
    {
        // Arrange
        $expectedDate = new \DateTimeImmutable('2021-10-05');
        $format = 'Y-m-d';

        $dateProvider = $this->createMock(DateProviderInterface::class);
        $dateProvider
            ->expects(self::once())
            ->method('getDate')
            ->willReturn($expectedDate);

        $subject = new CustomDatePrinter($dateProvider);

        // Act
        $result = $subject->printDate($format);

        // Assert
        self::assertEquals($expectedDate->format($format), $result);
    }
}
