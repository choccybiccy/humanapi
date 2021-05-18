<?php

namespace Choccybiccy\HumanApi;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

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
     * Get data as array
     *
     * @return array
     */
    public function all()
    {
        return $this->data[0]->all();
    }
    
    /**
     * Get data as array
     *
     * @return array
     */
    public function data()
    {
        return $this->data;
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
     * Get current
     *
     * @return Model
     */
    public function current()
    {
        return $this->getIterator()->current();
    }
    
    /**
     * Get valid
     *
     * @return Model
     */
    public function valid()
    {
        return $this->getIterator()->valid();
    }
    
    /**
     * Get key
     *
     * @return Model
     */
    public function key()
    {
        return $this->getIterator()->key();
    }
    
    /**
     * Get next
     *
     * @return Model
     */
    public function next()
    {
        return $this->getIterator()->next();
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
