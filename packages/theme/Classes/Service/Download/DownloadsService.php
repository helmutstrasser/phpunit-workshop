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

namespace Workshop\Theme\Service\Download;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\SingletonInterface;
use Workshop\Theme\Domain\Model\Product;
use Workshop\Theme\Domain\Repository\CategoryRepository;

readonly class DownloadsService implements SingletonInterface
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected FileRepository $fileRepository,
        protected ConnectionPool $connectionPool,
        protected LoggerInterface $logger,
    ) {
    }

    /**
     * @param \Workshop\Theme\Domain\Model\Product $product
     *
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public function getOrderedDownloadsOfProduct(Product $product): array
    {
        $fileReferences = [];

        try {
            $files = $this->fileRepository->findByRelation(
                'tx_productfinderae_product',
                'downloads',
                $product->getUid()
            );
        } catch (\Throwable $e) {
            $this->logger->warning($e->getMessage(), [$e]);
            $files = [];
        }

        /** @var FileReference $file */
        foreach ($files as $file) {
            $categoryUid = $this->categoryRepository->getCategoryUidOfRererence($file);

            if ($categoryUid) {
                if (empty($fileReferences[$categoryUid])) {
                    $fileReferences[$categoryUid] = [];
                }

                $fileReferences[$categoryUid][] = $file;
            }
        }

        $result = [];

        if ($fileReferences) {
            $qb = $this->connectionPool->getQueryBuilderForTable('sys_category');
            $qb->select('*');
            $qb->from('sys_category');
            $qb->where($qb->expr()->in('uid', array_keys($fileReferences)));
            $qb->orderBy('sorting', 'ASC');

            $stmt = $qb->executeQuery();

            foreach ($stmt->fetchAllAssociative() as $category) {
                $result[] = [
                    'category' => $category,
                    'files'    => $fileReferences[$category['uid']],
                ];
            }
        }

        return $result;
    }
}
