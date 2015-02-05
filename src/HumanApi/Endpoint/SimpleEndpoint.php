<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class SimpleEndpoint
 * @package Choccybiccy\HumanApi\Endpoint
 */
abstract class SimpleEndpoint extends Endpoint
{

    /**
     * @var bool
     */
    protected $listReturnsArray = false;

    /**
     * {@inheritDoc}
     */
    protected function buildListUrl()
    {
        return $this->buildUrlParts(array(
            $this->type,
        ));
    }

    /**
     * {@inheritDoc}
     */
    protected function buildSpecificEntryUrl($id)
    {
        throw new EndpointException("This endpoint does not support specific entries");
    }

    /**
     * {@inheritDoc}
     */
    public function buildRecentUrl()
    {
        throw new EndpointException("This endpoint does not support recent entries");
    }
}