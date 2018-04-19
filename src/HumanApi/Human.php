<?php

namespace Choccybiccy\HumanApi;

/**
 * Class Human
 * @package Choccybiccy\HumanApi
 */
class Human
{

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param string $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get endpoint
     *
     * @param string $endpoint
     * @return Endpoint
     * @codeCoverageIgnore
     */
    public function get($endpoint)
    {
        $endpoint = "\\Choccybiccy\\HumanApi\\Endpoint\\" . ucfirst($endpoint);
        if (class_exists($endpoint)) {
            /** @var Endpoint $endpoint */
            $endpoint = new $endpoint;
            $endpoint->setDefaultOption('verify', false);
            $endpoint->setAccessToken($this->accessToken);

            return $endpoint;

        }
    }
}
