<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Component\Routing;

use E_motion\Component\Routing\Exception\RouteLoaderException;
use E_motion\Component\Routing\Exception\InvalidRouteException;
use E_motion\Core\Util\StringTool;

final class RouteLoader
{
    private static $routes;

    public function init(): void
    {
        $routes = \yaml_parse_file(CONFIG_PATH . $_ENV['ENV_MODE'] . '/routes.yaml');
        if (false === $routes) {
            throw new RouteLoaderException('Failed to parse routes.yaml !');
        }

        //check fo each route if it is valid
        foreach ($routes as $route => $data) {
            if (!is_array($data) || !isset($data['url'], $data['controller'], $data['controller_action'])) {
                throw new InvalidRouteException('Route not valid ! : ' . $route);
            }
            if (true === StringTool::isEmpty($data['url'],$data['controller'], $data['controller_action'])) {
                throw new InvalidRouteException('Route not valid ! Each key of [url,controller,controller_action] must have a value ,for route : '. $route);
            }
            if ('/' !== substr($data['url'], 0, 1)) {
                throw new InvalidRouteException('Route "' . $route . '" url must begin with a slash !');
            }
            if (isset($data['param'])) {
                if (!is_array($data['param'])) {
                    throw new InvalidRouteException('Invalid parameters for route : ' . $route);
                } else {
                    $params = $data['param'];
                    foreach ($params as $param => $type) {
                        if (\preg_match('#[^a-zA-Z0-9_]+#', preg_quote($param, '#')) ||
                            \preg_match('#[\s]+#', preg_quote($param, '#'))) {
                            throw new InvalidRouteException('A route parameter must contain only english alphabet chars (and in option underscore or number) ! ' .
                                'Route invalid : "' . $route . '"'
                            );
                        }

                        switch ($type) {
                            case 'string':
                            case '%s':
                            case'int':
                            case'integer':
                            case'%d':
                            case'digit':
                                break;
                            default:
                                throw new InvalidRouteException('Invalid parameter type for route : <' . $route . '>');
                                break;
                        }
                    }
                }
            }
        }
        self::$routes = $routes;
        define('ROUTES', $routes);
    }

    public static function getRoutes(): ?array
    {
        return self::$routes;
    }
}
