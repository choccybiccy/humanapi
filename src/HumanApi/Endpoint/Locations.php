<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Locations
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Locations extends SimpleEndpoint
{

    /**
     * @var string
     */
    protected $type = "locations";

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
