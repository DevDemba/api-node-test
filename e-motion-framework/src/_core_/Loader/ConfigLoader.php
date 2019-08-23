<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Loader;

use E_motion\Core\Exception\ConfigException;

final class ConfigLoader implements LoaderInterface
{
    private $config_file = CONFIG_PATH . 'config.yaml';
    private $config;

    public function init(): void
    {
        $needToParse = false;

        if(!isset($_ENV['ENV_MODE'])) {
            $needToParse = true;
        }

        if(!isset($_ENV['ENABLE_CACHING_ROUTES'])) {
            $needToParse = true;
        }

        if($needToParse === true) {
            $this->config = \yaml_parse_file($this->config_file);
            if(!isset($this->config['env_mode'])) {
                throw new ConfigException('Key "env_mode" missing in config.yaml !');
            }
            if(!isset($this->config['enable_caching_routes'])) {
                throw new ConfigException('Key "enable_caching_routes" missing !');
            }
            $_ENV['ENV_MODE'] = $this->config['env_mode'];
            $_ENV['ENABLE_CACHING_ROUTES'] = $this->config['enable_caching_routes'];
        }
        $this->check();
    }

    private function check(): void
    {
        if('dev' !== $_ENV['ENV_MODE'] && 'prod' !== $_ENV['ENV_MODE']) {
            throw new ConfigException('Invalid Environment Mode , prod or dev only !');
        }
        switch ($_ENV['ENABLE_CACHING_ROUTES']) {
            case 'true': case '1':
            case 'false': case '0':
                break;
            default:
                throw new ConfigException('Invalid value for "Caching routes". The value must be a boolean value (0,1,true,false) !');
                break;
        }
        define('ENV_MODE',$_ENV['ENV_MODE']);
    }
}
