<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Collection;

abstract class AbstractNumericKeysCollection extends AbstractCollection implements NumericKeysCollectionInterface
{
    public function first()
    {
        return $this->items[0] ?? null;
    }

    public function last()
    {
        $s = \count($this->items);
        return $this->items[$s-1] ?? null;
    }

    public function clearItem(int $pos, bool $keepKeys=false): void
    {
        if(true === \array_key_exists(0,$this->items)) {
            if(true === $keepKeys) {
                unset($this->items[$pos]);
            } else {
                \array_splice($this->items,$pos,1);
            }
        }
    }
}
