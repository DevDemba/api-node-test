<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\InputOutput;

use E_motion\Core\Debug\ErrorHandler;
use E_motion\Core\InputOutput\Exception\DirException;
use E_motion\Core\InputOutput\Exception\DirNotReadableException;
use E_motion\Core\InputOutput\Exception\DirNotWritableException;
use E_motion\Core\InputOutput\Exception\InvalidDirException;

final class DirectoryInfo
{
    private static $lastError = '';

    /*
     * include php files in a directory
     * include all files in sub dirs if $recursive = true
     */
    public static function includePhpFiles(string $path, bool $recursive = false): void
    {
        clearstatcache(true);
        if(!is_dir($path)) {
            try {
                throw new InvalidDirException($path);
            } catch (DirException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
                return;
            }
        }
        if(!is_readable($path)) {
            try {
                throw new DirNotReadableException($path);
            } catch (DirNotReadableException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
                return;
            }
        }

        $result = scandir($path);
        array_splice($result,0,2);

        if(true === $recursive) {
            $reScan = function ($dir) use (&$reScan) {
                clearstatcache(true);
                $result = array();
                $contents = scandir($dir);
                array_splice($contents,0,2);
                $dir .= \substr($dir,-1,1)==='/' ? '' : '/';
                foreach ($contents as $key => $value) {
                    $item = $dir . $value;
                    if (!in_array($value,['.','..'])) {
                        if (is_dir($item)) {
                            $reScan($item);
                        } elseif(is_file($item) && preg_match('#.php$#s',$item)) {
                            ob_start();
                            // to avoid fatal error, we use require_once
                            require_once $item;
                            ob_end_clean();
                        } else {
                            trigger_error('Failed to include : '.$item,E_USER_WARNING);
                        }
                    }
                }
                return $result;
            };
            $result = $reScan($path);
        } else {
            $path .= substr($path,-1,1)==='/' ? '' : '/';
            for($i=0,$t=count($result); $i<$t; $i++) {
                $item = $path . $result[$i];
                if(is_file($item) && preg_match('#.php$#s',$item)) {
                    ob_start();
                    require_once $item;
                    ob_end_clean();
                }
            }
        }
    }

    public static function scan(string $path, bool $recursive = true): ?array
    {
        clearstatcache(true);
        if(!is_dir($path)) {
            try {
                throw new InvalidDirException($path);
            } catch (InvalidDirException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
                return null;
            }
        }
        if(!is_readable($path)) {
            try {
                throw new DirNotReadableException($path);
            } catch (DirNotReadableException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
                return null;
            }
        }

        $result = scandir($path);
        array_splice($result,0,2);

        if(true === $recursive) {
            $reScan = function ($dir) use (&$reScan) {
                $result = [];
                $contents = scandir($dir);
                foreach ($contents as $key => $value) {
                    if (!in_array($value,array('.','..'))) {
                        if (is_dir($dir . '/' . $value)) {
                            $result[$value] = $reScan($dir . '/' . $value);
                        } else {
                            $result[$value] = 1;
                        }
                    }
                }
                return $result;
            };
            $result = $reScan($path);
        }
        return $result;
    }

    /*
     * @return true if all contents are deleted
     */
    public static function emptyDir(string $dir): bool
    {
        if(!is_dir($dir)) {
            try {
                throw new InvalidDirException($dir);
            } catch (InvalidDirException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
            }
        }
        if(!is_readable($dir)) {
            try {
                throw new DirNotReadableException();
            } catch (DirNotReadableException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
            }
        }
        if(!is_writable($dir)) {
            try {
                throw new DirNotWritableException();
            } catch (DirNotWritableException $exception) {
                ErrorHandler::handleError(E_WARNING,$exception->getMessage(),__FILE__,__LINE__,[]);
            }
        }
        $success = true;
        $contents = self::scan($dir);

        $dir .= substr($dir,-1,1)==='/'? '' : '/';
        clearstatcache(true);

        $ok=false;
        foreach($contents as $key => $value) {
            $item = $dir.$key;
            if(is_file($item)) {
                $ok = unlink($item);
            } elseif(is_dir($item)) {
                self::emptyDir($item);
            }

            if($ok===false) {
                $success=false;
            }
        }
        rmdir($dir);
        return $success;
    }
}

class_alias('E_motion\Core\InputOutput\DirectoryInfo','E_motion\Core\IO\DirectoryInfo');
class_alias('E_motion\Core\InputOutput\DirectoryInfo','E_motion\Core\IO\DirInfo');
