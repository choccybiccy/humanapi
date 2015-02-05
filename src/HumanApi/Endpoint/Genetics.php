<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Genetics
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Genetics extends SimpleEndpoint
{

    /**
     * @var string
     */
    protected $type = "genetic/traits";

    /**
     * @var bool
     */
    protected $listReturnsArray = true;
}
