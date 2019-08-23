<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Collection\Unique;

use E_motion\Core\Collection\AbstractNumericKeysCollection;
use E_motion\Core\Collection\CollectionInterface;

class StringUnique extends AbstractNumericKeysCollection implements UniqueInterface
{

    public function updateFromArray(array $array): void
    {

    }

    public function updateFromCollection(CollectionInterface $collection): void
    {
        if(!$collection instanceof StringUnique) {
            throw new \InvalidArgumentException('Invalid collection ! Excepted type : ' . StringUnique::class . ', given '.get_class($collection).' .');
        }
    }
}
