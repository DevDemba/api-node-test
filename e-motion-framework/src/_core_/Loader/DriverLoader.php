<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Loader;

use E_motion\Core\Exception\InvalidDriverException;

final class DriverLoader implements LoaderInterface
{
    private $driver_path = CORE_PATH . 'drivers/';
    private $drivers;

    public function init() : void
    {
        $drivers = \glob($this->driver_path.'*');
        for($i=0, $nb_drivers=\count($drivers); $i<$nb_drivers; $i++) {
            if(\is_dir($drivers[$i]) &&
                \file_exists($this->driver_path . $drivers[$i] . '/driver.php')) {
            } else {
                try {
                    throw new InvalidDriverException("\nDriver invalid : ".$drivers[$i]);
                } catch (InvalidDriverException $e) {

                }

            }
        }
    }

}
