<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Collection\LambdaList;

use E_motion\Core\Collection\AbstractNumericKeysCollection;
use E_motion\Core\Collection\CollectionInterface;
use E_motion\Core\Util\ArrayTool;

class SimpleList extends AbstractNumericKeysCollection
{

    public function updateFromArray(array $array): void
    {
        if(!ArrayTool::areArrayKeysNumeric($array)) {
            throw new \InvalidArgumentException('Keys of array must be only numeric !');
        }
    }

    public function updateFromCollection(CollectionInterface $collection): void
    {
        if(!$collection instanceof SimpleList) {
            throw new \InvalidArgumentException('Invalid collection ! Excepted type : ' . SimpleList::class . ', given '.get_class($collection).' .');
        }
    }
}
