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

namespace Unit\Controller;

use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\View\TemplateView;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Controller\UserController;
use Workshop\Theme\Domain\Repository\UserRepository;

final class UserControllerTest extends UnitTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[NoReturn]
    #[Test]
    public function indexActionReturnsHtmlResponse(): void
    {
        $queryResult = self::createStub(QueryResultInterface::class);

        $userRepository = self::createMock(UserRepository::class);
        $userRepository
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($queryResult);

        $defaultViewObject = self::createMock(TemplateView::class);
        $defaultViewObject
            ->expects(self::once())
            ->method('assign')
            ->with('users', $queryResult);

        $response = self::createStub(ResponseInterface::class);

        $sut = self::getAccessibleMock(
            UserController::class,
            [
                'htmlResponse',
            ],
            [
               $userRepository,
            ]
        );
        $sut->_set('view', $defaultViewObject);

        $sut
            ->expects(self::once())
            ->method('htmlResponse')
            ->willReturn($response);

        $result = $sut->indexAction();

        self::assertInstanceOf(ResponseInterface::class, $result);
    }

    #[NoReturn]
    #[Test]
    public function isActionController(): void
    {
        $this->assertInstanceOf(
            ActionController::class,
            new UserController(new UserRepository())
        );
    }
}
