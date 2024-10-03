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

namespace Unit\ViewHelpers;

use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\Core\Variables\VariableProviderInterface;
use Workshop\Theme\ViewHelpers\FalViewHelper;

final class FalViewHelperTest extends UnitTestCase
{
    /**
     * Reset singleton instances
     *
     * @var bool $resetSingletonInstances
     */
    protected bool $resetSingletonInstances = true;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[NoReturn]
    #[Test]
    public function renderStatic(): void
    {
        // Arrange
        $tableName = 'tt_content';
        $fieldName = 'image';
        $uid = 1;
        $localizedUid = 2;
        $as = 'objects';

        $file1 = $this->createMock(FileRepository::class);
        $file2 = $this->createMock(FileRepository::class);
        $fileReferences = [$file1, $file2];

        $repository = $this->createMock(FileRepository::class);
        $repository
            ->expects(self::once())
            ->method('findByRelation')
            ->with(
                $tableName,
                $fieldName,
                $localizedUid
            )
            ->willReturn($fileReferences);

        GeneralUtility::setSingletonInstance(FileRepository::class, $repository);

        $expected = 'HTML content';

        $closure = fn () => $expected;

        $vars = $this->createMock(VariableProviderInterface::class);
        $vars
            ->expects(self::once())
            ->method('add')
            ->with($as, $fileReferences);
        $vars
            ->expects(self::once())
            ->method('remove')
            ->with($as);

        $renderingContext = $this->createMock(RenderingContext::class);
        $renderingContext
            ->expects(self::once())
            ->method('getVariableProvider')
            ->willReturn($vars);

        $arguments = [
            'uid'          => $uid,
            'localizedUid' => $localizedUid,
            'as'           => $as,
            'tableName'    => $tableName,
            'fieldName'    => $fieldName,
        ];

        // Act
        $subject = FalViewHelper::renderStatic($arguments, $closure, $renderingContext);

        // Assert
        self::assertSame($expected, $subject);
    }
}
