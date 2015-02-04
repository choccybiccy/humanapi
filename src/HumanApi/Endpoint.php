<?php

namespace Choccybiccy\HumanApi;

class Endpoint
{

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * Endpoint constructor
     *
     * @param HttpClient $client HTTP Client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
}
