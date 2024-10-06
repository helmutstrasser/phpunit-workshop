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

namespace Workshop\Theme\Domain\Model;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

class User extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $firstname = '';

    /**
     * @var string
     */
    protected string $lastname = '';

    /**
     * @Extbase\ORM\Lazy
     * @var FileReference|LazyLoadingProxy|null
     */
    protected null|FileReference|LazyLoadingProxy $avatar = null;

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastname . ', ' . $this->firstname;
    }

    /**
     * @return FileReference|null
     */
    public function getAvatar(): ?FileReference
    {
        if ($this->avatar instanceof LazyLoadingProxy) {
            $this->avatar = $this->avatar->_loadRealInstance();
        }

        return $this->avatar;
    }

    /**
     * @param FileReference $avatar
     */
    public function setAvatar(FileReference $avatar): void
    {
        $this->avatar = $avatar;
    }
}
