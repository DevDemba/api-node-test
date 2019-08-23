<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\InputOutput\Exception;

use Throwable;

class InvalidDirException extends DirException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Invalid directory ! : "'.$message . '"';
        parent::__construct($message, $code, $previous);
    }
}
