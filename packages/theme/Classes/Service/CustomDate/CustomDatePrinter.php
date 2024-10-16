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

namespace Workshop\Theme\Service\CustomDate;

readonly class CustomDatePrinter
{
    public function __construct(
        private DateProviderInterface $dateProvider
    ) {
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function printDate(string $format): string
    {
        $date = $this->dateProvider->getDate();

        return $date->format($format);
    }
}
