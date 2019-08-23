<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\Routing;

final class Route
{
    private $name;
    private $controller;
    private $controller_action;
    private $url;

    public function getController() : ?string
    {
        return $this->controller;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function getControllerAction() : ?string
    {
        return $this->controller_action;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function setControllerAction(string $controller_action): void
    {
        $this->controller_action = $controller_action;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
