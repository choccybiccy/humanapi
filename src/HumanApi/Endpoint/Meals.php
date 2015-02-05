<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class Meals
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Meals extends Endpoint
{

    /**
     * @var string
     */
    protected $type = "food/meals";

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
