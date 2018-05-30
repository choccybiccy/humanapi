<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Exception\UnexpectedResponseException;
use Choccybiccy\HumanApi\Exception\UnsupportedBatchEndpointException;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Application
 * @package Choccybiccy\HumanApi
 */
class Application extends Api
{

    /**
     * @var string
     */
    protected $appKey;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * Supported batch endpoints
     * @var array
     */
    protected $supportedBatchEndpoints = array(
        "activities",
        "activities/summaries",
        "heart_rates",
        "bmis",
        "body_fats",
        "heights",
        "weights",
        "blood_glucoses",
        "blood_oxygens",
        "sleeps",
        "blood_pressures",
        "genetic_traits",
        "locations",
        "food/meals",
    );

    /**
     * Constructor
     *
     * @param string $appKey HumanAPI app key
     * @param string $clientId HumanAPI client ID
     */
    public function __construct($appKey, $clientId)
    {

        $this->appKey = $appKey;
        $this->clientId = $clientId;

        parent::__construct();

    }

    /**
     * Batch get endpoint data
     *
     * @param string $endpoint
     * @param array $params
     * @return Collection
     * @throws UnsupportedBatchEndpointException
     */
    public function batch($endpoint, array $params = array())
    {

        if (!in_array($endpoint, $this->supportedBatchEndpoints)) {
            throw new UnsupportedBatchEndpointException("Batch endpoint '" . $endpoint . "' is not supported");
        }

        $response = $this->get(
            $this->buildUrlParts(array($this->clientId, "users", $endpoint), "apps"),
            array(
                "auth" => array(
                    $this->appKey,
                    ""
                ),
                "query" => $params
            )
        );

        $responseJson = json_decode($response->getBody(), true);
        return $this->buildCollection($responseJson);

    }

    /**
     * Get users
     *
     * @return Collection
     */
    public function getUsers()
    {

        $response = $this->get(
            $this->buildUrlParts(array($this->clientId, "users"), "apps"),
            array(
                "auth" => array(
                    $this->appKey,
                    ""
                )
            )
        );


        $responseJson = json_decode($response->getBody(), true);
        return $this->buildCollection($responseJson);

    }

    /**
     * Get user by human ID
     *
     * @param string $humanId Human ID
     * @return Model
     */
    public function getUserById($humanId)
    {

        $response = $this->get(
            $this->buildUrlParts(array($this->clientId, "users", $humanId), "apps"),
            array(
                "auth" => array(
                    $this->appKey,
                    ""
                )
            )
        );


        $responseJson = json_decode($response->getBody(), true);
        return new Model($responseJson, $this);

    }

    /**
     * Delete a user by human ID
     *
     * @param string $humanId Human ID
     * @return bool
     * @throws \Exception
     */
    public function deleteUserById($humanId)
    {

        try {
            $response = $this->delete(
                $this->buildUrlParts(array($this->clientId, "users", $humanId), "apps"),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    )
                )
            );

            if ($response->getStatusCode() != 204) {
                throw new UnexpectedResponseException(
                    "Couldn't delete the user, response from API was: "
                    . $response->getReasonPhrase()
                );
            }

            return true;

        } catch (RequestException $e) {
            throw new UnexpectedResponseException("Couldn't delete the user. Does the human ID exist?");

        }

    }
}
