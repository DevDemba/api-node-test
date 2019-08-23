<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\Bundle\Entity;

abstract class AbstractUser extends AbstractEntity implements UserInterface
{
    protected $id;
    protected $email;
    protected $lastname;
    protected $firstname;
    protected $gender;
    protected $password;

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getGender() : string
    {
        return $this->gender;
    }

    public function getEmail(): string
    {
        return $this->id;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setPassword(string $password): void
    {
       $this->password = $password;
    }

    public function securePassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => PASSWORD_BCRYPT_DEFAULT_COST]);
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
}
