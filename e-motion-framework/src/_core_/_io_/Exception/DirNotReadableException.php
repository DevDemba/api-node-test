<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\InputOutput\Exception;

use Throwable;

class DirNotReadableException extends ElementNotReadableException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $text = 'Directory not readable ! : '.$message;
        parent::__construct($text, $code, $previous);
    }
}
