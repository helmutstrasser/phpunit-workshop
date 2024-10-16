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

namespace Unit\Service\Download;

use Doctrine\DBAL\Result;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\NullLogger;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Domain\Model\Product;
use Workshop\Theme\Domain\Repository\CategoryRepository;
use Workshop\Theme\Service\Download\DownloadsService;

final class DownloadsServiceTest extends UnitTestCase
{
    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function getOrderedDownloadsOfProduct(): void
    {
        $productUid = 5;
        $product = new Product();
        $product->_setProperty('uid', $productUid);

        $categoryUid = 10;
        $category = [
            'uid'   => $categoryUid,
            'title' => 'fooBar',
        ];

        $fileReference = self::createStub(FileReference::class);

        $files = $this->createMock(FileRepository::class);
        $files
            ->expects(self::once())
            ->method('findByRelation')
            ->with(
                self::equalTo('tx_productfinderae_product'),
                self::equalTo('downloads'),
                self::equalTo($product->getUid())
            )
            ->willReturn([$fileReference]);

        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository
            ->expects(self::once())
            ->method('getCategoryUidOfRererence')
            ->with(self::equalTo($fileReference))
            ->willReturn($category['uid']);

        $stmt = self::createStub(Result::class);
        $stmt
            ->method('fetchAllAssociative')
            ->willReturn([$category]);

        $qb = $this->createStub(QueryBuilder::class);
        $qb->method('select')->willReturnSelf();
        $qb->method('from')->willReturnSelf();
        $qb->method('where')->willReturnSelf();
        $qb->method('orderBy')->willReturnSelf();
        $qb->method('executeQuery')->willReturn($stmt);

        $connectionPool = $this->createMock(ConnectionPool::class);
        $connectionPool
            ->expects(self::once())
            ->method('getQueryBuilderForTable')
            ->with(self::equalTo('sys_category'))
            ->willReturn($qb);

        $expected = [
            [
                'category' => $category,
                'files'    => [$fileReference],
            ],
        ];

        $sut = new DownloadsService($categoryRepository, $files, $connectionPool, new NullLogger());
        $actual = $sut->getOrderedDownloadsOfProduct($product);

        self::assertEquals($expected, $actual);
    }
}
