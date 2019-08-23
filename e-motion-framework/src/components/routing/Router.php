<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\Routing;

use E_motion\Component\Routing\Exception\NoRoutesException;
use E_motion\Component\Routing\Exception\RouteNotFoundException;
use E_motion\Component\Routing\Exception\InvalidRouteException;

final class Router
{
    private $routes = ROUTES;

    private static $currentRouteParams = [];

    public function getRouteData(string $url): Route
    {
        $route = new Route();
        foreach ($this->routes as $routeName => $data) {
            if (strcmp($url, $data['url']) === 0) {
                $route->setName($routeName);
                $route->setController($data['controller']);
                $route->setUrl($data['url']);
                $route->setControllerAction($data['controller_action']);
                return $route;
            } else {
                if ($this->routeHasParam($data)) {
                    $pattern = '/^'.\preg_quote($data['url'],'/');
                    $params = $this->getDefinedRouteParam($data);
                    foreach ($params as $param => $type) {
                        $search = '\{' . $param . '\}';
                        switch ($type) {
                            case 'string': case 'str':case 'default':
                                $pattern = \str_replace($search, '(.*[^0-9]+.*)', $pattern);
                                break;
                            case 'integer':case 'int':case '%d':
                                $pattern = \str_replace($search, '(-?[0-9]+)', $pattern);
                                break;
                            default:
                                continue;
                                break;
                        }
                    }
                    $pattern .= '$/si';
                    $ok = \preg_match($pattern, $url, $found);
                    if ($ok) {
                        $route->setName($routeName);
                        $route->setController($data['controller']);
                        $route->setUrl($data['url']);
                        $route->setControllerAction($data['controller_action']);
                        return $route;
                    }
                }
            }
        }
        throw new RouteNotFoundException('No route found for this url : '.$url);
    }

    private function routeHasParam(array $route_data)
    {
        return isset($route_data['param']) && \is_array($route_data['param']);
    }

    private function getDefinedRouteParam(array $route_data): ?array
    {
        return isset($route_data['param']) && \is_array($route_data['param']) ? $route_data['param'] : null;
    }

    public function getRouteParams()
    {
        return self::$currentRouteParams;
    }

    private function setCurrentRouteParams(array $params)
    {
        self::$currentRouteParams = $params;
    }
}
