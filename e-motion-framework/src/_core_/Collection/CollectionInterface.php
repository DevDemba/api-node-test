<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Collection;

interface CollectionInterface
{
    /*
     * Returns first collection's element
     * @return null|mixed
     */
    public function first();

    /*
     * Returns last collection's element
     * @return null|mixed
     */
    public function last();

    /*
     * Clears all elements in the collection
    */
    public function clear(): void;

    /*
     * Checks if collection is empty
     */
    public function isEmpty(): bool;

    /*
     * It returns the total number of elements in the collection
     */
    public function size(): int;

    /*
     * Returns an array that contains all collection's elements
     */
    public function getAll(): array;

    /*
     * Replaces all collection items by all $array items
     */
    public function updateFromArray(array $array): void;

    /*
     * Replaces all collection items by a collection $collection items
     */
    public function updateFromCollection(CollectionInterface $collection): void;
}
