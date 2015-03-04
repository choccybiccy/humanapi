<?php

namespace Choccybiccy\HumanApi;

use SebastianBergmann\Exporter\Exception;

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
     * @var stdClass
     */
    protected $sessionTokenObject;

    /**
     * Constructor
     *
     * @see https://docs.humanapi.co/docs/connect-backend
     *
     * @param string $sessionTokenObject
     * @param string $clientSecret
     */
    public function __construct($sessionTokenObject, $clientSecret)
    {

        $sessionTokenObject = $this->decodeJson($sessionTokenObject);
        $sessionTokenObject->clientSecret = $clientSecret;
        $this->sessionTokenObject = $sessionTokenObject;

        parent::__construct();

    }

    /**
     * Finish the auth flow and post to connect endpoint
     */
    public function finish()
    {
        $response = $this->post(
            $this->buildUrlParts(array("tokens"), "connect"),
            array(
                "json" => (array) $this->sessionTokenObject,
            )
        );
    }

    /**
     * Decode JSON data
     *
     * @param string $str JSON data
     * @return stdClass
     */
    protected function decodeJson($str)
    {
        $str = preg_replace("/([a-zA-Z0-9_]+?):/" , "\"$1\":", $str); // fix variable names
        return json_decode($str);
    }
}