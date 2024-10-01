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

namespace Unit\ViewHelpers\Render;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Core\ApplicationContext;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\ViewHelpers\Render\InlineSvgViewHelper;

/**
 * InlineSvgViewHelperTest
 */
final class InlineSvgViewHelperTest extends UnitTestCase
{
    /**
     * Reset singleton instances
     *
     * @var bool $resetSingletonInstances
     */
    protected bool $resetSingletonInstances = true;

    /**
     * @var string $fileName
     */
    private string $fileName = 'image.svg';

    /**
     * @var string $svgContent
     */
    private string $svgContent = '<svg></svg>';

    /**
     * @var string $rootPath
     */
    private string $rootPath = 'vfs://root';

    public function setUp(): void
    {
        parent::setUp();

        $applicationContext = new ApplicationContext('Development');
        Environment::initialize(
            $applicationContext,
            true,
            true,
            $this->rootPath,
            $this->rootPath,
            '/app/var',
            '/app/config',
            '/app',
            'Linux'
        );

        $root = vfsStream::setup();
        $file = vfsStream::newFile($this->fileName)->at($root);
        $file->setContent($this->svgContent);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackageException
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackagePathException
     * @throws \TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException
     */
    #[Test]
    public function renderStatic(): void
    {
        $arguments = [
            'source'            => $this->fileName,
            'remove-styles'     => false,
            'fill'              => '',
            'uniqueId'          => 'uniqueId',
            'custom-tags'       => '',
            'custom-attributes' => '',
        ];

        $renderChildrenClosure = fn () => null;
        $renderingContext = $this->getTypoScriptFrontendControllerMock();

        $sut = InlineSvgViewHelper::renderStatic($arguments, $renderChildrenClosure, $renderingContext);

        self::assertStringContainsString('<svg role="img" aria-hidden="true"></svg>', $sut);
    }

    /**
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackageException
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackagePathException
     */
    #[Test]
    public function getFilePath(): void
    {
        $result = InlineSvgViewHelper::getFilePath($this->fileName);

        self::assertSame($this->rootPath . '/' . $this->fileName, $result);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackageException
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackagePathException
     */
    #[Test]
    public function getFilePathWithExt(): void
    {
        $packageManager = $this->createMock(PackageManager::class);
        $packageManager->expects(self::once())
            ->method('resolvePackagePath')
            ->with('EXT:theme/Resources/Public/Images/' . $this->fileName)
            ->willReturn('foobar');

        // Prevent the actual class from being instantiated in the sut:
        GeneralUtility::setSingletonInstance(PackageManager::class, $packageManager);

        $result = InlineSvgViewHelper::getFilePath('EXT:theme/Resources/Public/Images/' . $this->fileName);

        // Assert, condition 'EXT' is true
        self::assertStringNotContainsString('.svg', $result);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackageException
     * @throws \TYPO3\CMS\Core\Package\Exception\UnknownPackagePathException
     * @throws \TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException
     */
    #[Test]
    public function renderStaticThrowsFileDoesNotExistException(): void
    {
        self::expectException(FileDoesNotExistException::class);

        $arguments = [
            'source' => 'not-existing.svg',
        ];

        $renderChildrenClosure = fn () => null;

        $renderingContext = $this->getTypoScriptFrontendControllerMock();

        InlineSvgViewHelper::renderStatic($arguments, $renderChildrenClosure, $renderingContext);
    }

    #[Test]
    public function sanitizeId(): void
    {
        $sut = InlineSvgViewHelper::sanitizeId('aäöbü*c+#d');

        self::assertSame('a____b___c__d', $sut);
    }

    /**
     * @return \TYPO3\CMS\Fluid\Core\Rendering\RenderingContext
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    private function getTypoScriptFrontendControllerMock(): RenderingContext
    {
        $typoScriptFrontendController = $this->createMock(TypoScriptFrontendController::class);
        $request = (new ServerRequest())->withAttribute('frontend.controller', $typoScriptFrontendController);
        $renderingContext = $this->createMock(RenderingContext::class);
        $renderingContext->method('getRequest')->willReturn($request);

        return $renderingContext;
    }
}
