<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\HttpIce;

class Server
{
    public static function getRequestMethod() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getClientIp() : string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function getServerIp() : string
    {
        return $_SERVER['SERVER_ADDR'];
    }
}
