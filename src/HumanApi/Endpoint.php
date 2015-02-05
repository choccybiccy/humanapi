<?php

namespace Choccybiccy\HumanApi;

/**
 * Class Endpoint
 * @package Choccybiccy\HumanApi
 */
abstract class Endpoint
{

    /**
     * @var string
     */
    protected $apiUrl = "https://api.humanapi.co";

    /**
     * @var int
     */
    protected $apiVersion = 1;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $plural;

    /**
     * Build a url that returns a list of entries
     *
     * @return string
     */
    abstract protected function buildListUrl();

    /**
     * Build a url that returns a specific entry
     *
     * @param int $id ID
     * @return string
     */
    abstract protected function buildSpecificEntryUrl($id);

    /**
     * Build a url that returns recent entry
r     *
     * @return string
     */
    abstract protected function buildRecentUrl();

    /**
     * Build a url up from parts
     *
     * @param array $parts
     * @return string
     */
    protected function buildUrlParts(array $parts)
    {
        $parts = array_merge(
            array(
                $this->apiUrl,
                "v" . $this->apiVersion,
                "human",
            ),
            $parts
        );
        return implode("/", $parts);
    }
}
