<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Debug;

use E_motion\Core\InputOutput\Program;

class ErrorHandler
{
    private static $showError = false;

    private static $errors = [];

    /*
     * @return void
     */
    public static function init()
    {
        $displayErrors = \strtolower(\ini_get('display_errors'));
        $displayStartupErrors = strtolower(\ini_get('display_startup_errors'));

        self::$showError = $displayErrors === 'on'||
        $displayErrors === '1' ||
        $displayStartupErrors === 'on' ||
        $displayStartupErrors === '1' ||
        $_ENV['ENV_MODE'] === 'dev'
            ? true :
            false;
        register_shutdown_function('E_motion\Core\Debug\ErrorHandler::shutdown');
    }

    /*
    * @return string
    */
    private static function prepareView(string $subject, array $params)
    {
        $view = $subject;
        foreach ($params as $param => $value) {
            $view = \str_replace('{{ '.$param.' }}',$value,$view);
        }
        return $view;
    }

    /*
     * @return string
     */
    protected static function viewCli(Error $error)
    {
        $text = "\033[0;37;41m%s\033[0;39;49m";
        $head = sprintf($text,str_repeat(" ",30));
        $foot = sprintf($text,str_repeat(" ",30));
        $marginLeftRight = sprintf($text,str_repeat(" ",2));
        $msg = sprintf($text,'An error has triggered !');
        $view = sprintf("\n%s\n%s%s%s\n%s",$head,$marginLeftRight,$msg,$marginLeftRight,$foot);
        $view .= "\nError triggered : " . \get_class($error->getErrorClass());
        $view .= "\nFile : " . $error->getErrorFile();
        $view .= "\nLine : " . $error->getFileLine();
        $view .= "\nMessage : " . $error->getErrorClass()->getMessage();
        $view .= "\n".$separator = str_repeat("-",34)."\n";
        return $view;
    }

    /*
     * @return string
     */
    protected static function viewHTML(Error $error, $shutdown=false)
    {
        $html = $shutdown===true ? '/../views/error.html' : '/../views/alert.html';
        $view = \file_get_contents(__DIR__ . $html);

        if(false === $shutdown) {
            return self::prepareView($view,[
                'alert-type'=>$error->getType(),
                'env_mode'=>$_ENV['ENV_MODE'],
                'error_class' => get_class($error->getErrorClass()),
                'error_type'=> ucfirst($error->getType()),
                'error_message' => $error->getErrorClass()->getMessage(),
                'file' => $error->getErrorFile(),
                'line' => $error->getFileLine(),
            ]);
        }

        return self::prepareView($view,[
            'env_mode'=>$_ENV['ENV_MODE'],
            'error_class' => get_class($error->getErrorClass()),
            'error_message' => $error->getErrorClass()->getMessage(),
            'file' => $error->getErrorFile(),
            'line' => $error->getFileLine(),
            'traces' => $error->getErrorClass()->getTraceAsString()
        ]);
    }

    /*
     * @return void
     */
    public static function shutdown()
    {
        $last_error = error_get_last();
        $type = '';
        switch($last_error['type']){
            case E_ERROR:
                $type = 'Error';
                break;
            case E_PARSE:
                $type = 'ParseError';
                break;
            case E_CORE_ERROR:
                $type = 'CoreError';
                break;
            case E_COMPILE_ERROR:
                $type = 'CompileError';
                break;
        }
        if(null !== $last_error && is_array($last_error) && count($last_error)>0 ) {
            $file = $last_error['file'];
            $message = $last_error['message'];
            $line = $last_error['line'];
            self::throwError(new Error(new \Error($message),$type,$file,$line));
        }

    }

    /*
     * @return bool
     */
    public static function handleError($errno, $errstr, $errfile, $errline,$context)
    {
        $title = '';
        $error_type = '';
        switch ($errno) {
            case E_USER_ERROR: case E_ERROR:
                $title = 'Error';
                $error_type = 'error';
                break;

            case E_USER_WARNING: case E_WARNING:
                $title = 'Warning';
                $error_type = 'warning';
                break;

            case E_USER_NOTICE: case E_NOTICE:
                $title = 'Notice';
                $error_type = 'notice';
            break;

            case E_USER_DEPRECATED:case E_DEPRECATED:
                $title = 'Deprecated';
                $error_type = 'warning';
                break;

            default:
                $title = 'Unknow Error';
                $error_type = 'error';
                break;
        }

        $error = new Error(new \Error($errstr,$errno,null),$error_type,$errstr,$errfile,$errline);
        if(Program::isCliMode()===true) {
            echo self::viewCli($error);
        } else {
            if($_ENV['ENV_MODE']==='dev') {
                echo self::viewHTML($error,false);
            }
        }
        return true;
    }

    /*
     * @return void
     */
    public static function throwError(\Error $error): void
    {
        if(!$error instanceof Error) {
            $error = new Error($error,'');
        }
        try {
            throw new $error;
        } catch (\Error $caught) {
            //
        } finally {
           if(Program::isCliMode()===true) {
               echo self::viewCli($error);
               return;
           }
           echo true === self::$showError ? self::viewHTML($error,true) : \file_get_contents(__DIR__ . '/../views/offline.html');
        }
    }
}
