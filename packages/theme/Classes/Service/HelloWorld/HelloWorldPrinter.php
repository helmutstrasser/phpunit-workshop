<?php
declare(strict_types=1);

namespace Workshop\Theme\Service\HelloWorld;

readonly class HelloWorldPrinter
{
    public function __construct(
        private TextProviderInterface $helloWorldProvider
    ) {}

    public function printHelloWorld(): string
    {
        return $this->helloWorldProvider->getText();
    }
}