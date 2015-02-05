<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Genetics
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Genetics extends Endpoint
{

    /**
     * @var string
     */
    protected $type = "genetics";

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
