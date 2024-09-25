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

namespace Unit\Service\HelloWorld;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Service\HelloWorld\HelloWorldPrinter;
use Workshop\Theme\Service\HelloWorld\TextProviderInterface;

final class HelloWorldPrinterTest extends UnitTestCase
{
    /**
     * Test to demonstrate
     *
     * - AAA
     * - how to mock a dependency
     * - that either the class or the interface can be mocked
     *
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function printHelloEurope(): void
    {
        $text = 'Hello Europe';
        $helloWorldProviderMock = self::createMock(TextProviderInterface::class);
        $helloWorldProviderMock
            ->expects(self::once())
            ->method('getText')
            ->willReturn($text);
        $helloWorldPrinter = new HelloWorldPrinter($helloWorldProviderMock);
        self::assertEquals($text, $helloWorldPrinter->printHelloWorld());
    }
}
