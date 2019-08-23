<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Debug;

class Error extends \Error
{
    private $fileLine = null;
    private $errorFile = null;
    private $type = '';
    private $errorClass;

    public function __construct(\Error $class,$type, $message='',$file=null,$line=null)
    {
        $this->errorFile = $file===null ? $class->getFile() : (string)$file;
        $this->fileLine = $line===null ? $class->getLine() : (int)$line;
        $this->type = $type;
        $this->errorClass = $class;
        $msg = $class->getMessage()==='' ? $message : $class->getMessage();
        parent::__construct($msg,$class->getCode(),null);
    }

    public function getFileLine()
    {
        return $this->fileLine;
    }

    public function getErrorFile()
    {
        return $this->errorFile;
    }

    /**
     * @return mixed
     */
    public function getErrorClass()
    {
        return $this->errorClass;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
