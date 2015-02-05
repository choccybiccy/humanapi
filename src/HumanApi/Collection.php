<?php

namespace Choccybiccy\HumanApi;

use ArrayIterator,
    Countable,
    IteratorAggregate,
    Traversable;

/**
 * Class Collection
 * @package Choccybiccy\HumanApi
 */
class Collection implements Countable, IteratorAggregate
{

    /**
     * @var array
     */
    protected $data = array();

    /**
     * Add to collection
     *
     * @param Model $model
     */
    public function add(Model $model)
    {
        $this->data[] = $model;
    }

    /**
     * Collection count
     *
     * @return int|void
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Get iterator
     *
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}
