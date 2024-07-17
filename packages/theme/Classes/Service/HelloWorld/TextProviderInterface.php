<?php
declare(strict_types=1);

namespace Workshop\Theme\Service\HelloWorld;

interface TextProviderInterface
{
    public function getText(): string;
}