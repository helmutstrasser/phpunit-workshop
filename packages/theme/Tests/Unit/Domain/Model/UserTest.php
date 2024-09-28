<?php

declare(strict_types=1);

namespace Workshop\Theme\Domain\Model;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

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
