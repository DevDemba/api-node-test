<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Collection;

abstract class AbstractCollection implements CollectionInterface
{
    protected $items = [];

    public function clear(): void
    {
        $this->items = [];
    }

    public function size(): int
    {
        return \count($this->items);
    }

    public function getAll(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return \count($this->items) > 0 ? false : true;
    }
}
