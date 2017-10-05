<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class AuthTest
 * @package Choccybiccy\HumanApi
 */
class AuthTest extends \PHPUnit_Framework_TestCase
{

    use ReflectionMethods;

    /**
     * Get mock response
     *
     * @param int $statusCode Response status code
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockResponse($statusCode = 204)
    {
        $response =  $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->setMethods(array("getBody", "getStatusCode", "getReasonPhrase"))
            ->getMockForAbstractClass();
        $response->expects($this->any())
            ->method("getBody")
            ->willReturn(json_encode(array()));
        $response->expects($this->any())
            ->method("getStatusCode")
            ->willReturn($statusCode);
        return $response;
    }

    /**
     * Test auth
     */
    public function testAuth()
    {

        $sessionTokenData = array(
            "humanId" => "exampleHumanId",
            "clientId" => "exampleClientId",
            "sessionToken" => "exampleSessionToken",
        );

        $clientSecret = "exampleClientSecret";

        $auth = $this->getMockBuilder("Choccybiccy\\HumanApi\\Auth")
            ->setConstructorArgs(array($sessionTokenData, $clientSecret))
            ->setMethods(array("post"))
            ->getMock();

        $auth->expects($this->once())
            ->method("post")
            ->with(
                $this->runProtectedMethod(
                    $auth,
                    "buildUrlParts",
                    array(array("tokens"), "connect")
                ),
                array(
                    "json" => array_merge($sessionTokenData, array("clientSecret" => $clientSecret)),
                )
            )
            ->willReturn($this->getMockResponse());

        $auth->finish();

    }
}
