<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;
use Choccybiccy\HumanApi\Exception\UnsupportedEndpointMethodException;

/**
 * Class SimpleEndpoint
 * @package Choccybiccy\HumanApi\Endpoint
 */
abstract class MedicalEndpoint extends Endpoint
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
        return $this->buildUrlParts(array(
            $this->type,
            $id,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function buildRecentUrl()
    {
        throw new UnsupportedEndpointMethodException("This endpoint does not support recent entries");
    }
}
