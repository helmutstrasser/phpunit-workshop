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

/**
 * Extension Manager/Repository config file for ext "theme".
 */
$EM_CONF[$_EXTKEY] = [
    'title'       => 'Theme',
    'description' => 'Sitepackage',
    'category'    => 'templates',
    'constraints' => [
        'depends' => [
            'typo3'                => '12.4.0-12.4.99',
            'fluid_styled_content' => '12.4.0-12.4.99',
            'rte_ckeditor'         => '12.4.0-12.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Workshop\\Theme\\' => 'Classes',
        ],
    ],
    'state'            => 'stable',
    'uploadfolder'     => 0,
    'createDirs'       => '',
    'clearCacheOnLoad' => 1,
    'author'           => 'Helmut Strasser',
    'author_email'     => 'h.strasser@supseven.at',
    'author_company'   => 'supseven e.U.',
    'version'          => '1.0.0',
];
