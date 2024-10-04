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

namespace Unit\Domain\Model;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Domain\Model\User;

final class UserTest extends UnitTestCase
{
    /**
     * @var User
     */
    protected User $sut;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = new User();
    }

    #[Test]
    public function getFullName(): void
    {
        // Arrange
        $firstname = 'John';
        $lastname = 'Doe';

        // Act
        $this->sut->setFirstname($firstname);
        $this->sut->setLastname($lastname);

        // Assert
        self::assertSame($lastname . ', ' . $firstname, $this->sut->getFullName());
    }

    #[Test]
    public function isAbstractModel(): void
    {
        self::assertInstanceOf(AbstractEntity::class, $this->sut);
    }

    #[Test]
    public function getFirstNameIsEmptyString(): void
    {
        self::assertEmpty($this->sut->getFirstname());
    }

    #[Test]
    public function setTitle(): void
    {
        $firstName = 'John';
        $this->sut->setFirstname($firstName);
        self::assertSame($firstName, $this->sut->getFirstname());
    }

    #[Test]
    public function getAvatarIsEmpty(): void
    {
        self::assertNull($this->sut->getAvatar());
    }

    /**
     * @throws Exception
     */
    #[Test]
    public function setAvatar(): void
    {
        $fileReferenceDummy = self::createStub(FileReference::class);
        $this->sut->setAvatar($fileReferenceDummy);
        self::assertInstanceOf(FileReference::class, $this->sut->getAvatar());
    }
}
