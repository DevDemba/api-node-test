<?php

define('HOME',
    substr(strtolower(PHP_OS),0,3)==='win' ?
        str_replace(['\\', basename($_SERVER['PHP_SELF'])], ['/', ''], $_SERVER['PHP_SELF']) :
        str_replace(basename($_SERVER['PHP_SELF']),'', $_SERVER['PHP_SELF']),
    false
);
define('SESSION_PATH',ROOT . 'var/session/');
