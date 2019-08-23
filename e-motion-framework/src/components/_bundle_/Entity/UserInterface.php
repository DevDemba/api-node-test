<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\Bundle\Entity;

interface UserInterface
{
    public function setLastname(string $lastname) : void;
    public function setFirstname(string $firstname) : void;
    public function setEmail(string $email) : void;
    public function setPassword(string $password) : void;
    public function getLastname() : string;
    public function getFirstname(): string;
    public function getEmail() : string;
    public function getPassword() : string;
}
