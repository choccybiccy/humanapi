<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Locations
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Locations extends Endpoint
{

    /**
     * @var string
     */
    protected $type = "locations";

    /**
     * {@inheritDoc}
     */
    protected function buildListUrl()
    {

    }

    /**
     * {@inheritDoc}
     */
    protected function buildSpecificEntryUrl($id)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function buildRecentUrl()
    {
        throw new EndpointException("This endpoint does not support a recent entries");
    }

}
