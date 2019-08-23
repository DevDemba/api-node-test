<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

use E_motion\Core\InputOutput\Program;
use E_motion\Core\Debug\ThrowableHandler;

error_reporting(E_ALL);
if('cli'===php_sapi_name()) {
    ini_set('display_errors','on');
    ini_set('display_startup_errors','on');
} else {
    ini_set('display_errors','off');
    ini_set('display_startup_errors','off');
}

require_once  __DIR__ . '/core_const.php';

$_ENV['ENV_MODE'] = isset($_ENV['ENV_MODE']) ? $_ENV['ENV_MODE'] : 'dev';

define('PHP_VERSION_MSG','Can\'t run this application, you must use php with version 7.2.0 or higher !',false);
define('YAML_EXTENSION_MSG','Make sure php yaml extension is installed and enabled !',false);

if(PHP_VERSION_ID < 70200) {
    try {
        throw new RuntimeException(PHP_VERSION_MSG);
    } catch (Exception $e) {
        $msg = $e->getMessage();
        if('cli' === php_sapi_name()) {
            echo sprintf("\n\033[0;37;41mException occurred: %s  \033[0;39;49m\n",$msg);
        } else {
            echo '<h1>'.$msg.'</h1>';
        }
        die;
    }
}

require __DIR__ . '/../vendor/autoload.php';

ThrowableHandler::init();

if(!function_exists('yaml_parse_file')) {
    try {
        throw new RuntimeException(YAML_EXTENSION_MSG);
    } catch (Exception $e) {
        $msg = $e->getMessage();
        if(true === Program::isCliMode()) {
            echo sprintf("\n\033[0;37;41mException occurred:  %s  \033[0;39;49m\n",$msg);
        } else {
            echo '<h1>'.$msg.'</h1>';
        }
        die;
    }
}

(new E_motion\Core\Loader\ConfigLoader)->init();
(new E_motion\Core\Loader\DriverLoader)->init();
