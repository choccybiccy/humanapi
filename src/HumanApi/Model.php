<?php

namespace Choccybiccy\HumanApi;

/**
 * Class Model
 * @package Choccybiccy\HumanApi
 */
class Model
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @var Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param array $data
     * @param Api $api
     */
    public function __construct(array $data, Api $api = null)
    {
        $this->data = $data;
        $this->api = $api;
    }

    /**
     * Get data
     *
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (preg_match("/get([A-Z]{1}([A-Za-z]+))/is", $method, $match)) {
            $key = lcfirst($match[1]);
            return $this->get($key);
        }
    } // @codeCoverageIgnore

    /**
     * Get data as array
     *
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }
}
