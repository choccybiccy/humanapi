<?php

namespace Choccybiccy\HumanApi;

/**
 * Class Auth
 * @package Choccybiccy\HumanApi
 */
class Auth extends Api
{

    /**
     * @var string
     */
    protected $apiUrl = "https://user.humanapi.co";

    /**
     * @var int
     */
    protected $apiVersion = 1;

    /**
     * @var array
     */
    protected $sessionTokenData;

    /**
     * Constructor
     *
     * @see https://docs.humanapi.co/docs/connect-backend
     *
     * @param array $sessionTokenData
     * @param string $clientSecret
     */
    public function __construct(array $sessionTokenData, $clientSecret)
    {

        $sessionTokenData['clientSecret'] = $clientSecret;
        $this->sessionTokenData = $sessionTokenData;

        parent::__construct();

    }

    /**
     * Finish the auth flow and post to connect endpoint, and return response array
     * containing accessToken and other data about the 'human' entity.
     *
     * @return array
     */
    public function finish()
    {
        $response = $this->post(
            $this->buildUrlParts(array("tokens"), "connect"),
            array(
                "json" => $this->sessionTokenData,
            )
        );
        return json_decode($response->getBody(),true); //json decode applied
    }
}
