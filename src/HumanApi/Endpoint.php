<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Collection;
use GuzzleHttp\Client;

/**
 * Class Endpoint
 * @package Choccybiccy\HumanApi
 */
abstract class Endpoint extends Client
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
     * @var string
     */
    protected $method = "get";

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var bool
     */
    protected $listReturnsArray = true;

    /**
     * Set access token
     *
     * @param string $accessToken Access token
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get list of entries
     *
     * @param array $params
     * @return Collection
     */
    public function getList(array $params = array())
    {

        $url = $this->buildListUrl();
        return $this->fetchResults($url, $params);

    }

    /**
     * Get entry by ID
     *
     * @param int $id
     * @param array $params
     * @return Collection
     */
    public function getById($id, array $params = array())
    {
        $this->listReturnsArray = false;
        $url = $this->buildSpecificEntryUrl($id);
        return $this->fetchResults($url, $params);
    }

    /**
     * Get recent entry
     *
     * @param array $params
     * @return Collection
     */
    public function getRecent(array $params = array())
    {
        $url = $this->buildRecentUrl();
        return $this->fetchResults($url, $params);
    }

    /**
     * Fetch results
     *
     * @param string $url
     * @param array $params
     * @return Collection
     */
    protected function fetchResults($url, array $params = array())
    {
        /** @var \GuzzleHttp\Message\Response $response */
        $response = call_user_func_array(
            array($this, $this->method),
            array(
                $url,
                array(
                    "query" => array(
                        "access_token" => $this->accessToken,
                    )
                )
            )
        );

        $json = $response->json();
        if(!$this->listReturnsArray) {
            $json = array($json);
        }

        return $this->buildCollection($json);

    }

    /**
     * Build collection
     *
     * @param array $data
     * @return Collection
     */
    protected function buildCollection(array $data)
    {
        $collection = new Collection();
        foreach($data as $row) {
            foreach(array("createdAt", "updatedAt", "timestamp", "startTime", "endTime") as $key) {
                if(array_key_exists($key, $row)) {
                    $row[$key] = new \DateTime($row[$key]);
                }
            }
            $model = new Model($row, $this);
            $collection->add($model);
        }
        return $collection;
    }

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
     *
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
