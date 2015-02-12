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
     * @var Endpoint
     */
    protected $endpoint;

    /**
     * Constructor
     *
     * @param array $data
     * @param Endpoint $endpoint
     */
    public function __construct(array $data, Endpoint $endpoint)
    {
        $this->data = $data;
        $this->endpoint = $endpoint;
    }

    /**
     * Get data
     *
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        if(array_key_exists($key, $this->data)) {
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
        if(preg_match("/get([A-Z]{1}([A-Za-z]+))/is", $method, $match)) {
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
     * @return Endpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
