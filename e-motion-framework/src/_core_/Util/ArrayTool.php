<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Util;

class ArrayTool
{
    public static function areArrayKeysNumeric(array $array): bool
    {
        $keys = \array_keys($array);
        $t = \count($keys);
        for($i=0; $i<$t; $i++) {
            if(\preg_match('/[^0-9]/',$keys[$i])) {
                return false;
            }
        }
        return true;
    }
}
