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

    /**
     * {@inheritDoc}
     */
    protected function buildSpecificEntryUrl($id)
    {
        return $this->buildUrlParts(array(
            $this->type,
            $id,
        ));
    }
}
