<?php

declare(strict_types=1);

namespace Workshop\Theme\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
}
