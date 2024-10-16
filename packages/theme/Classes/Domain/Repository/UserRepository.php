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

namespace Workshop\Theme\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Workshop\Theme\Domain\Model\User;

/**
 * @extends Repository<User>
 */
class UserRepository extends Repository
{
    /**
     * Find the user that is marked as organiser
     *
     * @return \Workshop\Theme\Domain\Model\User
     */
    public function findOrganiser(): User
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('isOrganiser', true)
        );

        return $query->execute()->getFirst();
    }
}
