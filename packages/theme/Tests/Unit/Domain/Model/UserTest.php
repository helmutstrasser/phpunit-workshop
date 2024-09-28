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
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\Domain\Model\User;

final class UserTest extends UnitTestCase
{
    #[Test]
    public function getFullName(): void
    {
        // Arrange
        $firstname = 'John';
        $lastname = 'Doe';

        // Act
        $sut = new User();
        $sut->setFirstname($firstname);
        $sut->setLastname($lastname);

        // Assert
        self::assertSame($lastname . ', ' . $firstname, $sut->getFullName());
    }
}
