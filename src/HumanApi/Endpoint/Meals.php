<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Meals
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Meals extends SimpleEndpoint
{

    /**
     * @var string
     */
    protected $type = "food/meals";

    /**
     * @var bool
     */
    protected $listReturnsArray = true;
}
