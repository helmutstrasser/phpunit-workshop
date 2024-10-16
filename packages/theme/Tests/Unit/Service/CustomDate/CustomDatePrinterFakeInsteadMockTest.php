<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public Licence, either version 2
 * of the Licence, or any later version.
 *
 * For the full copyright and licence information, please read the
 * LICENCE file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Unit\Service\CustomDate;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Service\CustomDate\CustomDatePrinter;
use Workshop\Theme\Service\CustomDate\DateProviderInterface;

final class CustomDatePrinterFakeInsteadMockTest extends UnitTestCase
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

        // Fake a class which implements the DateProviderInterface
        // Just ensure calling the getDate() method returns what we expect
        $dateProvider = new readonly class ($expectedDate) implements DateProviderInterface {
            public function __construct(
                private \DateTimeImmutable $expectedDate
            ) {
            }

            /**
             * @param \DateTimeImmutable $date
             *
             * @return void
             */
            public function setDate(\DateTimeImmutable $date): void
            {
                // No need to set anything here. We just "fake" this method, as we are not
                // interested in any logic, how the parameter is actually set.
            }

            /**
             * @return \DateTimeImmutable
             */
            public function getDate(): \DateTimeImmutable
            {
                // No need to implement any logic here.
                // We just return what we expect, if the method is called outside.
                return $this->expectedDate;
            }
        };

        $subject = new CustomDatePrinter($dateProvider);

        // Act
        $result = $subject->printDate($format);

        // Assert
        self::assertEquals($expectedDate->format($format), $result);
    }
}
