<?php

declare(strict_types=1);

namespace Unit\Service\HelloWorld;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Service\HelloWorld\HelloWorldPrinter;
use Workshop\Theme\Service\HelloWorld\TextProviderInterface;

/**
 * HelloWorldPrinterFakerTest
 *
 * This test is identical to HelloWorldPrinterTest, but uses a faker instead of a mock.
 */
final class HelloWorldPrinterFakerTest extends UnitTestCase
{
    #[Test]
    public function printHelloWorld(): void
    {
        $expected = 'Foo Bar';

        // Instead of creating a mock, we initialize a fake class that implements the interface.
        $textProviderInterfaceFake = new readonly class ($expected) implements TextProviderInterface {
            public function __construct(
                private string $expected
            ) {
            }

            public function getText(): string
            {
                return $this->expected;
            }
        };

        $sut = new HelloWorldPrinter($textProviderInterfaceFake);
        $actual = $sut->printHelloWorld();

        self::assertEquals($expected, $actual);
    }
}
