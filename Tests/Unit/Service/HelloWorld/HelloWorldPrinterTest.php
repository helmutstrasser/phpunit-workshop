<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Service\HelloWorld\HelloWorldPrinter;
use Workshop\Theme\Service\HelloWorld\HelloWorldProvider;

class HelloWorldPrinterTest extends UnitTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function printHelloEurope(): void
    {
        $text = "Hello Europe";
        $helloWorldProviderMock = self::createMock(HelloWorldProvider::class);
        $helloWorldProviderMock->expects(self::once())
            ->method('getText')
            ->willReturn($text);
        $helloWorldPrinter = new HelloWorldPrinter($helloWorldProviderMock);
        self::assertEquals($text, $helloWorldPrinter->printHelloWorld());
    }
}