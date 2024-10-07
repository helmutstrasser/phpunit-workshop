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

use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;
use Workshop\Theme\Controller\UserController;
use Workshop\Theme\Domain\Repository\UserRepository;

final class UserControllerTest extends UnitTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function indexActionReturnsHtmlResponse(): void
    {
        $queryResult = self::createStub(QueryResultInterface::class);

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($queryResult);

        $view = $this->createMock(ViewInterface::class);
        $view
            ->expects(self::once())
            ->method('assign')
            ->with(
                'users',
                $queryResult
            )
            ->willReturnSelf();

        $responseInterface = self::createStub(ResponseInterface::class);

        $sut = self::getAccessibleMock(
            UserController::class,
            [
              'htmlResponse',
            ],
            [
                $userRepository,
            ],
        );

        $sut->_set('view', $view);

        $sut
            ->expects(self::once())
            ->method('htmlResponse')
            ->willReturn($responseInterface);

        self::assertInstanceOf(ResponseInterface::class, $sut->indexAction());
    }

    #[Test]
    public function isActionController(): void
    {
        $this->assertInstanceOf(ActionController::class, new UserController(new UserRepository()));
    }
}
