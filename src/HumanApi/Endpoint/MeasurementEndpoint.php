<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class MeasurementEndpoint
 * @package Choccybiccy\HumanApi\Endpoint
 */
abstract class MeasurementEndpoint extends Endpoint
{

    /**
     * @var string
     */
    protected $plural = "readings";

    /**
     * {@inheritDoc}
     */
    protected function buildSpecificEntryUrl($id)
    {
        return $this->buildUrlParts(array(
            $this->type,
            $this->plural,
            $id
        ));
    }

    /**
     * {@inheritDoc}
     */
    protected function buildListUrl()
    {
        return $this->buildUrlParts(array(
            $this->type,
            $this->plural,
        ));
    }

    /**
     * {@inheritDoc}
     */
    protected function buildRecentUrl()
    {
        return $this->buildUrlParts(array(
            $this->type,
        ));
    }
}
