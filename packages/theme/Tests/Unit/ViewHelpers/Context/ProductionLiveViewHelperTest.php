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

namespace Unit\ViewHelpers\Context;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Core\ApplicationContext;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContext;
use Workshop\Theme\ViewHelpers\Context\ProductionLiveViewHelper;

/**
 * ProductionLiveViewHelperTest
 *
 * If this test fails with the error message
 * "TypeError : Return value of TYPO3\CMS\Core\Core\Environment::getContext() must be an instance of
 * TYPO3\CMS\Core\Core\ApplicationContext, null returned"
 * be sure to configure PhpStorm for PHPUnit to use the UnitTests.xml and UnitTestsBootstrap.xml configuration file.
 */
final class ProductionLiveViewHelperTest extends UnitTestCase
{
    protected bool $backupEnvironment = true;

    /**
     * @param string $context
     * @param bool $expected
     *
     * @throws \TYPO3\CMS\Core\Exception
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[DataProvider('applicationDataProvider')]
    #[Test]
    public function renderStatic(string $context, bool $expected): void
    {
        $applicationContext = new ApplicationContext($context);
        Environment::initialize(
            $applicationContext,
            true,
            true,
            '/app',
            '/app/private',
            '/app/var',
            '/app/config',
            '/app',
            'Linux'
        );

        $closureDummy = function (): void {
            UnitTestCase::fail('renderChildrenClosure must not be called');
        };
        $contextDummy = self::createStub(RenderingContext::class);

        $actual = ProductionLiveViewHelper::renderStatic([], $closureDummy, $contextDummy);

        self::assertEquals($expected, $actual);
    }

    public static function applicationDataProvider(): array
    {
        return [
            'Is testing' => [
                'Testing/Unit',
                false,
            ],
            'Is prod dev' => [
                'Production/Dev',
                false,
            ],
            'Is prod live' => [
                'Production/Live',
                true,
            ],
            'Is prod live-preview' => [
                'Production/Live/Preview',
                true,
            ],
        ];
    }
}
