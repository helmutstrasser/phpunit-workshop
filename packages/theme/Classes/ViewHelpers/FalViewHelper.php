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

namespace Workshop\Theme\ViewHelpers;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * FalViewHelper usage:
 *
 * <theme:fal table="pages" field="image" id="{row.uid}" as="references">
 *   <f:if condition="{references}">
 *    <f:then>
 *      <f:media file="{references.0}" class="foobar" title="{references.0.propertiesOfFileReference.title}"/>
 *    </f:then>
 *    <f:else>
 *      <img class="dummy" src="https://dummyimage.com/600x600/444/fff" alt="">
 *    </f:else>
 *   </f:if>
 * </theme:fal>
 */
class FalViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeChildren = false;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('uid', 'int', '', true);
        $this->registerArgument('localizedUid', 'int', '', false);
        $this->registerArgument('as', 'string', '', false, 'objects');
        $this->registerArgument('tableName', 'string', '', false, 'tt_content');
        $this->registerArgument('fieldName', 'string', '', false, 'image');
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $repository = GeneralUtility::makeInstance(FileRepository::class);
        $files = $repository->findByRelation($arguments['tableName'], $arguments['fieldName'], $arguments['localizedUid'] ?: $arguments['uid']);
        $as = $arguments['as'];
        $vars = $renderingContext->getVariableProvider();

        $vars->add($as, $files);
        $content = $renderChildrenClosure();
        $vars->remove($as);

        return $content;
    }
}
