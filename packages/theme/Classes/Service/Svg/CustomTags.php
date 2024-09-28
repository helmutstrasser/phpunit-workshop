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

namespace Workshop\Theme\Service\Svg;

use enshrined\svgSanitize\data\AllowedTags;
use enshrined\svgSanitize\data\TagInterface;

/**
 * Represents a set of custom tags that can be used in the Svg Sanitizer used in the InlineSvgViewHelper
 *
 * EXAMPLE:
 *
 * <theme:render.inlineSvg
 *      source="EXT:theme_project/Resources/Public/Images/Svg/Loading.svg"
 *      custom-tags="{ 0: 'animate' }"
 *      custom-attributes="{ 0: 'calcMode' }" />
 */
class CustomTags implements TagInterface
{
    private static array $allowedTags = [];

    public function __construct(array $tags)
    {
        self::$allowedTags = array_unique(array_merge(AllowedTags::getTags(), $tags));
    }

    public static function getTags(): array
    {
        return self::$allowedTags;
    }
}
