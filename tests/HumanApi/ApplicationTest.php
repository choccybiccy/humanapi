<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class ApplicationTest
 * @package Choccybiccy\HumanApi
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{

    use ReflectionMethods;

    /**
     * @var string
     */
    protected $appKey = "testAppKey";

    /**
     * @var string
     */
    protected $clientId = "testClientId";

    /**
     * Get mock application
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockApplication($methods = null)
    {
        $application = $this->getMockBuilder('Choccybiccy\HumanApi\Application')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
        $this->setProtectedProperty($application, "appKey", $this->appKey);
        $this->setProtectedProperty($application, "clientId", $this->clientId);
        return $application;
    }

    /**
     * Get mock response
     *
     * @param int $statusCode Response status code
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockResponse($statusCode = 204)
    {
        $response =  $this->getMockBuilder('GuzzleHttp\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->setMethods(array("json", "getStatusCode", "getReasonPhrase"))
            ->getMockForAbstractClass();
        $response->expects($this->any())
            ->method("json")
            ->willReturn(array());
        $response->expects($this->any())
            ->method("getStatusCode")
            ->willReturn($statusCode);
        return $response;
    }

    /**
     * Test construct
     */
    public function testConstruct()
    {

        $application = new Application($this->appKey, $this->clientId);
        $this->assertEquals($this->appKey, $this->getProtectedProperty($application, "appKey"));
        $this->assertEquals($this->clientId, $this->getProtectedProperty($application, "clientId"));

    }

    /**
     * Test that batch throws an exception when using an unsupported endpoint
     */
    public function testBatchThrowsExceptionWhenUsingUnsupportedEndpoint()
    {

        $application = $this->getMockApplication();
        $this->setExpectedException('Choccybiccy\HumanApi\Exception\UnsupportedBatchEndpointException');
        $application->batch("thisEndpointDoesntExist");

    }

    /**
     * Test batch
     */
    public function testBatch()
    {

        $endpoint = "activities";
        $params = array("limit" => 5);

        $application = $this->getMockApplication(array("get", "buildCollection"));

        $application->expects($this->once())
            ->method("get")
            ->with(
                $this->runProtectedMethod(
                    $application,
                    "buildUrlParts",
                    array(array($this->clientId, "users", $endpoint), "apps")
                ),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    ),
                    "query" => $params,
                )
            )
            ->willReturn($this->getMockResponse());

        $application->batch($endpoint, $params);

    }

    /**
     * Test get users
     */
    public function testGetUsers()
    {

        $application = $this->getMockApplication(array("get", "buildCollection"));

        $application->expects($this->once())
            ->method("get")
            ->with(
                $this->runProtectedMethod(
                    $application,
                    "buildUrlParts",
                    array(array($this->clientId, "users"), "apps")
                ),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    ),
                )
            )
            ->willReturn($this->getMockResponse());

        $application->getUsers();

    }

    /**
     * Test get user by id
     */
    public function testGetUserById()
    {

        $humanId = "testHumanId";
        $application = $this->getMockApplication(array("get", "buildCollection"));

        $application->expects($this->once())
            ->method("get")
            ->with(
                $this->runProtectedMethod(
                    $application,
                    "buildUrlParts",
                    array(array($this->clientId, "users", $humanId), "apps")
                ),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    ),
                )
            )
            ->willReturn($this->getMockResponse());

        $application->getUserById($humanId);

    }

    /**
     * Test delete user by id
     */
    public function testDeleteUserById($statusCode = 204)
    {

        $humanId = "testHumanId";
        $application = $this->getMockApplication(array("delete", "buildCollection"));

        $application->expects($this->once())
            ->method("delete")
            ->with(
                $this->runProtectedMethod(
                    $application,
                    "buildUrlParts",
                    array(array($this->clientId, "users", $humanId), "apps")
                ),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    ),
                )
            )
            ->willReturn($this->getMockResponse($statusCode));

        $application->deleteUserById($humanId);

    }

    /**
     * Test delete user throws RuntimeException when unexpected error code
     */
    public function testDeleteUserThrowsExceptionWhenWrongErrorCode()
    {
        $this->setExpectedException('\Choccybiccy\HumanApi\Exception\UnexpectedResponseException');
        $this->testDeleteUserById(500);
    }

    /**
     * Test delete user throws RuntimeException when
     */
    public function testDeleteUserThrowsExceptionWhenUnexpectedResponse()
    {

        $exception = $this->getMockBuilder('\GuzzleHttp\Exception\RequestException')
            ->disableOriginalConstructor()
            ->getMock();

        $humanId = "testHumanId";
        $application = $this->getMockApplication(array("delete", "buildCollection"));

        $application->expects($this->once())
            ->method("delete")
            ->with(
                $this->runProtectedMethod(
                    $application,
                    "buildUrlParts",
                    array(array($this->clientId, "users", $humanId), "apps")
                ),
                array(
                    "auth" => array(
                        $this->appKey,
                        ""
                    ),
                )
            )
            ->willThrowException($exception);

        $this->setExpectedException('\Choccybiccy\HumanApi\Exception\UnexpectedResponseException');
        $application->deleteUserById($humanId);

    }
}
