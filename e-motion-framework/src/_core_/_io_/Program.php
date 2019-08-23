<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\InputOutput;

class Program
{
    /*
     * @return int
     */
    public static function getVersionId()
    {
        return PHP_VERSION_ID;
    }

    /*
     * @return string
     */
    public static function getVersion()
    {
        return PHP_VERSION;
    }

    /*
     * @return bool
     */
    public static function isCliMode()
    {
        return 'cli' === php_sapi_name() ? true : false;
    }
}
