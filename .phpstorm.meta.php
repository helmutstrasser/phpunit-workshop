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

namespace PHPSTORM_META {
    // TYPO3 object factory
    override(\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(0), map([
        '' => '@',
    ]));

    // TYPO3 APIs,
    // from https://git.typo3.org/typo3/typo3/-/blob/main/.phpstorm.meta.php

    expectedArguments(
        \TYPO3\CMS\Core\Context\Context::getAspect(),
        0,
        'date',
        'visibility',
        'backend.user',
        'frontend.user',
        'workspace',
        'language',
        'typoscript'
    );
    override(\TYPO3\CMS\Core\Context\Context::getAspect(), map([
        'date' => \TYPO3\CMS\Core\Context\DateTimeAspect::class,
        'visibility' => \TYPO3\CMS\Core\Context\VisibilityAspect::class,
        'backend.user' => \TYPO3\CMS\Core\Context\UserAspect::class,
        'frontend.user' => \TYPO3\CMS\Core\Context\UserAspect::class,
        'workspace' => \TYPO3\CMS\Core\Context\WorkspaceAspect::class,
        'language' => \TYPO3\CMS\Core\Context\LanguageAspect::class,
        'typoscript' => \TYPO3\CMS\Core\Context\TypoScriptAspect::class,
    ]));
    expectedArguments(
        \TYPO3\CMS\Core\Context\DateTimeAspect::get(),
        0,
        'timestamp',
        'iso',
        'timezone',
        'full',
        'accessTime'
    );
    expectedArguments(
        \TYPO3\CMS\Core\Context\VisibilityAspect::get(),
        0,
        'includeHiddenPages',
        'includeHiddenContent',
        'includeDeletedRecords'
    );
    expectedArguments(
        \TYPO3\CMS\Core\Context\UserAspect::get(),
        0,
        'id',
        'username',
        'isLoggedIn',
        'isAdmin',
        'groupIds',
        'groupNames'
    );
    expectedArguments(
        \TYPO3\CMS\Core\Context\WorkspaceAspect::get(),
        0,
        'id',
        'isLive',
        'isOffline'
    );
    expectedArguments(
        \TYPO3\CMS\Core\Context\LanguageAspect::get(),
        0,
        'id',
        'contentId',
        'fallbackChain',
        'overlayType',
        'legacyLanguageMode',
        'legacyOverlayType'
    );
    expectedArguments(
        \TYPO3\CMS\Core\Context\TypoScriptAspect::get(),
        0,
        'forcedTemplateParsing'
    );

    expectedArguments(
        \Psr\Http\Message\ServerRequestInterface::getAttribute(),
        0,
        'frontend.user',
        'normalizedParams',
        'site',
        'language',
        'routing',
        'module',
        'moduleData',
        'frontend.controller',
        'frontend.typoscript',
    );
    override(\Psr\Http\Message\ServerRequestInterface::getAttribute(), map([
        'frontend.user' => \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::class,
        'normalizedParams' => \TYPO3\CMS\Core\Http\NormalizedParams::class,
        'site' => \TYPO3\CMS\Core\Site\Entity\SiteInterface::class,
        'language' => \TYPO3\CMS\Core\Site\Entity\SiteLanguage::class,
        'routing' => '\TYPO3\CMS\Core\Routing\SiteRouteResult|\TYPO3\CMS\Core\Routing\PageArguments',
        'module' => \TYPO3\CMS\Backend\Module\ModuleInterface::class,
        'moduleData' => \TYPO3\CMS\Backend\Module\ModuleData::class,
        'frontend.controller' => \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::class,
        'frontend.typoscript' => \TYPO3\CMS\Core\TypoScript\FrontendTypoScript::class,
    ]));

    expectedArguments(
        \TYPO3\CMS\Core\Http\ServerRequest::getAttribute(),
        0,
        'frontend.user',
        'normalizedParams',
        'site',
        'language',
        'routing',
        'module',
        'moduleData'
    );
    override(\TYPO3\CMS\Core\Http\ServerRequest::getAttribute(), map([
        'frontend.user' => \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::class,
        'normalizedParams' => \TYPO3\CMS\Core\Http\NormalizedParams::class,
        'site' => \TYPO3\CMS\Core\Site\Entity\SiteInterface::class,
        'language' => \TYPO3\CMS\Core\Site\Entity\SiteLanguage::class,
        'routing' => '\TYPO3\CMS\Core\Routing\SiteRouteResult|\TYPO3\CMS\Core\Routing\PageArguments',
        'module' => \TYPO3\CMS\Backend\Module\ModuleInterface::class,
        'moduleData' => \TYPO3\CMS\Backend\Module\ModuleData::class,
    ]));

    override(\TYPO3\CMS\Core\Routing\SiteMatcher::matchRequest(), type(
            \TYPO3\CMS\Core\Routing\SiteRouteResult::class,
            \TYPO3\CMS\Core\Routing\RouteResultInterface::class,
        )
    );

    override(\TYPO3\CMS\Core\Routing\PageRouter::matchRequest(), type(
        \TYPO3\CMS\Core\Routing\PageArguments::class,
        \TYPO3\CMS\Core\Routing\RouteResultInterface::class,
    ));

    override(\Psr\Container\ContainerInterface::get(0), map([
        '' => '@',
    ]));

    override(\Psr\EventDispatcher\EventDispatcherInterface::dispatch(0), map([
        '' => '@',
    ]));

    // PHPUnit APIs
    override(
        \PHPUnit\Framework\TestCase::createMock(0),
        map([
            '@&\PHPUnit\Framework\MockObject\MockObject',
        ])
    );

    override(
        \PHPUnit\Framework\TestCase::createStub(0),
        map([
            '@&\PHPUnit\Framework\MockObject\Stub',
        ])
    );

    override(
        \PHPUnit\Framework\TestCase::createConfiguredMock(0),
        map([
            '@&\PHPUnit\Framework\MockObject\MockObject',
        ])
    );

    override(
        \PHPUnit\Framework\TestCase::createPartialMock(0),
        map([
            '@&\PHPUnit\Framework\MockObject\MockObject',
        ])
    );

    override(
        \PHPUnit\Framework\TestCase::createTestProxy(0),
        map([
            '@&\PHPUnit\Framework\MockObject\MockObject',
        ])
    );

    override(
        \PHPUnit\Framework\TestCase::getMockForAbstractClass(0),
        map([
            '@&\PHPUnit\Framework\MockObject\MockObject',
        ])
    );
}
