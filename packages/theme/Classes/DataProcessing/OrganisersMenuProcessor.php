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

namespace Workshop\Theme\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use Workshop\Theme\Domain\Repository\UserRepository;

class OrganisersMenuProcessor implements DataProcessorInterface
{
    /**
     * the module name set in the backend
     */
    public const string MODULE = 'organisers';

    public function __construct(protected readonly UserRepository $userRepository)
    {
    }

    /**
     * @param ContentObjectRenderer $cObj
     * @param array $contentObjectConfiguration
     * @param array $processorConfiguration
     * @param array $processedData
     * @return array
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData): array
    {
        if (($processedData['data']['module'] ?? '') !== self::MODULE) {
            return $processedData;
        }

        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'organiser');
        $processedData[$targetVariableName] = $this->userRepository->findOrganiser();

        return $processedData;
    }
}
