<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Debug;

use E_motion\Core\InputOutput\Program;

final class ExceptionHandler
{
    private const EXCEPTION_TITLE = 'An exception has occured !';

    private static $showException = true;

    /*
     * @return void
     */
    public static function init()
    {
        $displayErrors = \strtolower(\ini_get('display_errors'));
        $displayStartupErrors = strtolower(\ini_get('display_startup_errors'));

        self::$showException = ($displayErrors === 'on'||
            $displayErrors === '1' ||
            $displayStartupErrors === 'on' ||
            $displayStartupErrors === '1' ||
            $_ENV['ENV_MODE'] === 'dev')
            ? true :
            false;
       // var_dump($displayErrors,self::$showException,$_ENV);
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
    protected static function viewCli(\Exception $exception)
    {
        $text = "\033[0;37;41m%s\033[0;39;49m";
        $t = strlen(self::EXCEPTION_TITLE);
        $head = sprintf($text,str_repeat(" ",$t+4));
        $foot = sprintf($text,str_repeat(" ",$t+4));
        $marginLeftRight = sprintf($text,str_repeat(" ",2));
        $msg = sprintf($text,self::EXCEPTION_TITLE);
        $view = sprintf("\n%s\n%s%s%s\n%s",$head,$marginLeftRight,$msg,$marginLeftRight,$foot);
        $view .= "\nException caught : " . \get_class($exception);
        $view .= "\nFile : " . $exception->getFile();
        $view .= "\nLine : " . $exception->getLine();
        $view .= "\nMessage : " . $exception->getMessage();
        $view .= "\n".$separator = str_repeat("-",34)."\n";
        return $view;
    }

    /*
     * @return string
     */
    protected static function viewHTML(\Exception $exception)
    {
        $view = \file_get_contents(__DIR__ . '/../views/exception.html');

        return self::prepareView($view,[
            'exception_class' => \get_class($exception),
            'env_mode'=>$_ENV['ENV_MODE'],
            'exception_message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'traces' => $exception->getTraceAsString()
        ]);
    }

    /*
     * @return void
     */
    public static function throwException(\Exception $exception): void
    {
        self::init();

        try {
            throw $exception;
        } catch (\Exception $e) {
            //
        } finally {
            if(true === Program::isCliMode()) {
                echo self::viewCli($exception);
                return;
            }
            echo true === self::$showException ? self::viewHTML($exception) : \file_get_contents(__DIR__ . '/../views/offline.html');
        }
    }
}
