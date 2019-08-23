<?php

namespace App;

use E_motion\Component\HttpIce\Request;
use E_motion\Component\HttpIce\Response;
use E_motion\Component\Routing\Route;
use E_motion\Component\Routing\Router;
use E_motion\Core\InputOutput\DirectoryInfo;

final class AppKernel
{
    private $request = null;

    public function handle(Request $request): Response
    {
        $this->request = $request;
        $route = (new Router)->getRouteData($request->getPath());
        return $this->callController($route->getController(), $route->getControllerAction());
    }

    public function terminate(Request $request,Response $response): void
    {
        if(null === $this->request) {
            throw new \RuntimeException('No request received !');
        }
        echo ($response->getBody());
    }

    protected function callController(string $object, string $method): Response
    {
        $params = [];
        if(!class_exists($object)){
            throw new \RuntimeException('Class not exists : "'.$object.'" ');
        }
        $reflectClass = new \ReflectionClass($object);
        if(false === $reflectClass->isInstantiable() || true === $reflectClass->isAbstract()) {
            throw new \RuntimeException('Not instantiable class : "'. $object.'" !');
        }
        $reflectMethod = new \ReflectionMethod($object, $method);
        $reflectParameters = $reflectMethod->getParameters();
        $returnType = $reflectMethod->getReturnType();

        if(null === $returnType || true === $returnType->allowsNull() || 'E_motion\Component\HttpIce\Response' !== $returnType->getName()) {
            throw new \RuntimeException('Return type of "'.$object.'::'.$method.'" must not null and must be "E_motion\Component\HttpIce\Response" !');
        }

        foreach ($reflectParameters as $parameter) {
            if (null !== $parameter->getType() || $parameter->allowsNull() === false) {
                $paramType = $parameter->getType()->getName();
                $reflectClass = new \ReflectionClass($paramType);
                if ($reflectClass->isInstantiable()) {
                    $params[] = new $paramType;
                } elseif ($reflectClass->isInterface()) {
                    $dir = dirname($reflectClass->getFileName());
                    DirectoryInfo::includePhpFiles($dir);
                    $interface = $reflectClass->getName();
                    $namespace = $reflectClass->getNamespaceName();
                    $classes = get_declared_classes();
                    $same = [];
                    $namespaces = [];
                    foreach ($classes as $class) {
                        $ref = new \ReflectionClass($class);
                        $namespaces [$ref->getNamespaceName()] = null;
                        if(array_key_exists($namespace,$namespaces) && $ref->isInstantiable()) {
                            $same[] = $class;
                        }
                    }
                    $count = count($same);
                    switch ($count) {
                        case 0:
                            throw new \RuntimeException('No class found that implements "'.$interface.'" !');
                            break;

                        case 1:
                            $params [] = new $same[0];
                            break;

                        default:
                            throw new \RuntimeException('Too many class implement the interface "'.$paramType.'" but i don\'t know which one to take !');
                            break;
                    }
                }
            } else {
                $params[] = null;
            }
        }

        $controller = new $object();
        if(!method_exists($controller,$method)) {
            throw new \RuntimeException('Method not exists for controller "'.$object.'" : "'.$method.'"');
        }
        $response = \call_user_func_array([$controller, $method], $params);
        return $response;
    }
}
