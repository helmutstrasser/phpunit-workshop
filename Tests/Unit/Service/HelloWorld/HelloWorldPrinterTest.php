<?php
declare(strict_types=1);

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
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function printHelloEurope(): void
    {
        $text = "Hello Europe";
        $helloWorldProviderMock = self::createMock(TextProviderInterface::class);
        $helloWorldProviderMock
            ->expects(self::once())
            ->method('getText')
            ->willReturn($text);
        $helloWorldPrinter = new HelloWorldPrinter($helloWorldProviderMock);
        self::assertEquals($text, $helloWorldPrinter->printHelloWorld());
    }
}