<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\HttpIce;

use E_motion\Component\Routing\Router;
use E_motion\Core\InputOutput\Program;

class Request
{
    const METHOD_HEAD = 'HEAD';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PURGE = 'PURGE';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_TRACE = 'TRACE';
    const METHOD_CONNECT = 'CONNECT';

    private $files = [];
    private $attributes = [];
    private $languages;
    private $method;
    private $uri;
    private $path;

    public function __construct()
    {
        $this->init();
    }

    private function init(): void
    {
        if(Program::isCliMode()===true) {
            return;
        }
        $this->files = $_FILES;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->languages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->setPath();
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getPath() : string
    {
        return $this->path;
    }

    public function getUri() : string
    {
        return $this->uri;
    }

    public function  getLanguages() : array
    {
        return $this->languages;
    }

    public function getFiles() : array
    {
        return $this->files;
    }

    public function getAllAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute(string $attribute): array
    {
        if(isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        } else {
            \trigger_error('Request attribute not exists !');
        }
    }

    private function setPath(): void
    {
        $lh = strlen(HOME);
        $this->path = '/';
        $this->path .= HOME === '/' ? \substr($_SERVER['REQUEST_URI'],1) : \substr($_SERVER['REQUEST_URI'],$lh);
    }
}
