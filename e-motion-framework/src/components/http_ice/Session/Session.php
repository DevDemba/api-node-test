<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\HttpIce\Session;

class Session implements SessionInterface
{
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /*
     * @return mixed
     */
    public function get(string $key)
    {

    }

    public function end()
    {
        $_SESSION = [];
    }
}
