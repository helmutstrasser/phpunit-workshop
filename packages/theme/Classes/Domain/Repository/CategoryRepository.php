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

namespace Workshop\Theme\Domain\Repository;

use Doctrine\DBAL\Statement;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;

class CategoryRepository
{
    private ?Statement $fetchCategoryUid = null;

    public function __construct(
        protected readonly FileRepository $fileRepository,
        protected readonly ConnectionPool $connectionPool
    ) {
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function getCategoryUidOfRererence(FileReference $file): ?int
    {
        if (!$this->fetchCategoryUid) {
            $qb = $this->connectionPool->getQueryBuilderForTable('sys_category_record_mm');
            $qb->select('uid_local');
            $qb->from('sys_category_record_mm');
            $qb->where(
                $qb->expr()->eq('tablenames', $qb->expr()->literal('sys_file_reference')),
                $qb->expr()->eq('fieldname', $qb->expr()->literal('categories')),
                $qb->expr()->eq('uid_foreign', '?')
            );
            $qb->setMaxResults(1);

            $this->fetchCategoryUid = $qb->prepare();
        }

        $result = $this->fetchCategoryUid->executeQuery([$file->getUid()]);
        $row = $result->fetchAllAssociative()[0] ?? [];

        return $row['uid_local'] ?? null;
    }
}
