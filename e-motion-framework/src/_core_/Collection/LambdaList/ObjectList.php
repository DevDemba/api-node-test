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

class ObjectList extends AbstractNumericKeysCollection implements LambdaListInterface
{
    protected $object;

    public function __construct(string $type)
    {
        $this->object = $type;
    }

    public function add(object $item)
    {
        if($item instanceof $this->object) {
            $this->items[] = $item;
        } else {
            throw new \InvalidArgumentException('Invalid object ! Excepted "'.$this->object.'" , given : "'.$item.'"');
        }
    }

    public function updateFromArray(array $array): void
    {
        if(!ArrayTool::areArrayKeysNumeric($array)) {
            throw new \InvalidArgumentException('Keys of array must be only numeric !');
        }
    }

    public function updateFromCollection(CollectionInterface $collection): void
    {
        if(!$collection instanceof ObjectList) {
            throw new \InvalidArgumentException('Invalid collection ! Excepted type : ' . ObjectList::class . ', given '.get_class($collection).' .');
        }
    }
}
