<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Debug;

class ThrowableHandler
{
    /*
     * @return void
     */
    public static function init()
    {
        ErrorHandler::init();
        \set_error_handler('E_motion\Core\Debug\ErrorHandler::handleError');
        \set_exception_handler(__CLASS__. '::handleException');
        ExceptionHandler::init();
    }

    /*
     * @return void
     */
    public static function handleException(\Throwable $throwable)
    {
        $class = get_class($throwable);
        $a = false;
        if($class !== 'ErrorException' && !$throwable instanceof \Error) {
            ExceptionHandler::throwException($throwable);
        } else {
            ErrorHandler::throwError($throwable);
        }
    }
}
