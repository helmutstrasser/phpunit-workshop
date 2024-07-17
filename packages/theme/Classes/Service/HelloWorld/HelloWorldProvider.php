<?php
declare(strict_types=1);

namespace Workshop\Theme\Service\HelloWorld;

class HelloWorldProvider implements TextProviderInterface
{
    public function getText(): string
    {
        return 'Hello World!';
    }
}