<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Sources
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Sources extends Endpoint
{

    /**
     * @var string
     */
    protected $type = "sources";

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
        throw new EndpointException("This endpoint does not support specific entries");
    }

    /**
     * {@inheritDoc}
     */
    public function buildRecentUrl()
    {
        throw new EndpointException("This endpoint does not support a recent entries");
    }
}
