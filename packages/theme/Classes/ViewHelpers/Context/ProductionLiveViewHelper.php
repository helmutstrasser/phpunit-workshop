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

namespace Workshop\Theme\ViewHelpers\Context;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ### Context: ProductionLive
 *
 * Returns true if the application context is Production/Live explicitly.
 *
 * #### Note about how to set the application context
 *
 * The context TYPO3 CMS runs in is specified through the environment variable TYPO3_CONTEXT.
 * It can be set by .htaccess or in the server configuration
 *
 * See: http://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Bootstrapping/Index.html#bootstrapping-context
 */
class ProductionLiveViewHelper extends AbstractConditionViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return bool
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): bool {
        return str_starts_with(Environment::getContext()->__toString(), 'Production/Live');
    }
}
