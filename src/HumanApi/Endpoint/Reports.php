<?php

namespace Choccybiccy\HumanApi\Endpoint;

/**
 * Class Reports
 * @package Choccybiccy\HumanApi\Endpoint
 */
class Reports extends MedicalEndpoint
{

    /**
     * @var string
     */
    protected $type = "medical/reports";

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
