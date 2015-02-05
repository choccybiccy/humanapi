<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Sources
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Sources extends SimpleEndpoint
{

    /**
     * @var string
     */
    protected $type = "sources";

    /**
     * @var bool
     */
    protected $listReturnsArray = true;
}
