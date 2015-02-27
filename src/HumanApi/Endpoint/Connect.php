<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Connect
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Connect extends SimpleEndpoint
{

    /**
     * @var string
     */
    protected $apiUrl = "https://user.humanapi.co";

    /**
     * @var string
     */
    protected $type = "connect/tokens";

    /**
     * @var string
     */
    protected $method = "post";
}
