<?php

namespace Choccybiccy\HumanApi;

use GuzzleHttp\Client;

/**
 * Class Api
 * @package Choccybiccy\HumanApi
 */
abstract class Api extends Client
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
    protected $method = "get";

    /**
     * Build collection
     *
     * @param array $data
     * @return Collection
     */
    protected function buildCollection(array $data)
    {
        $collection = new Collection();
        foreach ($data as $row) {
            foreach (array("createdAt", "updatedAt", "timestamp", "startTime", "endTime") as $key) {
                if (array_key_exists($key, $row)) {
                    $row[$key] = new \DateTime($row[$key]);
                }
            }
            $model = new Model($row, $this);
            $collection->add($model);
        }
        return $collection;
    }

    /**
     * Build a url up from parts
     *
     * @param array $parts
     * @param string $api API
     * @return string
     */
    protected function buildUrlParts(array $parts, $api = "human")
    {
        $parts = array_merge(
            array(
                $this->apiUrl,
                "v" . $this->apiVersion,
                $api,
            ),
            $parts
        );
        return implode("/", $parts);
    }
}
