<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Endpoint;

/**
 * Class PeriodicEndpoint
 * @package Choccybiccy\HumanApi\Endpoint
 */
abstract class PeriodicEndpoint extends Endpoint
{

    /**
     * @var string
     */
    protected $plural = "summaries";

    /**
     * {@inheritDoc}
     */
    protected function buildSpecificEntryUrl($id)
    {
        return $this->buildUrlParts(array(
            $this->type,
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
        ));
    }

    /**
     * {@inheritDoc}
     */
    protected function buildRecentUrl()
    {
        return $this->buildUrlParts(array(
            $this->type,
            $this->plural,
        ));
    }
}