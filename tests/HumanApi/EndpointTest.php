<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class EndpointTest
 * @package Choccybiccy\HumanApi
 */
class EndpointTest extends \PHPUnit_Framework_TestCase
{

    use ReflectionMethods;

    /**
     * Get mock endpoint
     *
     * @param array $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockEndpoint($methods = array())
    {
        return $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMockForAbstractClass();
    }

    /**
     * Test set/get accessToken
     */
    public function testSetGetAccessToken()
    {
        $endpoint = $this->getMockEndpoint();
        $accessToken = "testtoken";
        $endpoint->setAccessToken($accessToken);
        $this->assertEquals($accessToken, $endpoint->getAccessToken());
    }

    /**
     * Test build url parts
     */
    public function testBuildUrlParts()
    {
        $endpoint = $this->getMockEndpoint();
        $expected = implode("/", array(
            $this->getProtectedProperty($endpoint, "apiUrl"),
            "v" . $this->getProtectedProperty($endpoint, "apiVersion"),
            "human",
            "another",
            "part",
        ));
        $this->assertEquals(
            $expected,
            $this->runProtectedMethod($endpoint, "buildUrlParts", array(array("another", "part")))
        );
    }

    /**
     * Test get list
     */
    public function testGetList()
    {

        $params = array("test" => "param");
        $url = "test";

        $endpoint = $this->getMockEndpoint(array("buildListUrl", "fetchResults"));
        $endpoint->expects($this->once())
            ->method("buildListUrl")
            ->willReturn($url);
        $endpoint->expects($this->once())
            ->method("fetchResults")
            ->with($url, $params);
        $endpoint->getList($params);


    }

    /**
     * Test get by id
     */
    public function testGetById()
    {

        $id = 1;
        $params = array("test" => "param");
        $url = "test";

        $endpoint = $this->getMockEndpoint(array("buildSpecificEntryUrl", "fetchResults"));
        $endpoint->expects($this->once())
            ->method("buildSpecificEntryUrl")
            ->with($id)
            ->willReturn($url);
        $endpoint->expects($this->once())
            ->method("fetchResults")
            ->with($url, $params);
        $endpoint->getById($id, $params);

    }

    /**
     * Test get recent
     */
    public function testGetRecent()
    {

        $params = array("test" => "param");
        $url = "test";

        $endpoint = $this->getMockEndpoint(array("buildRecentUrl", "fetchResults"));
        $endpoint->expects($this->once())
            ->method("buildRecentUrl")
            ->willReturn($url);
        $endpoint->expects($this->once())
            ->method("fetchResults")
            ->with($url, $params);
        $endpoint->getRecent($params);


    }

    /**
     * Test build collection
     */
    public function testBuildCollection()
    {

        $data = array(
            array("name" => "test1", "createdAt" => date("Y-m-d H:i:s")),
            array("name" => "test2", "createdAt" => date("Y-m-d H:i:s")),
            array("name" => "test3", "createdAt" => date("Y-m-d H:i:s")),
            array("name" => "test4", "createdAt" => date("Y-m-d H:i:s")),
        );

        $endpoint = $this->getMockEndpoint();
        $collection = $this->runProtectedMethod($endpoint, "buildCollection", array($data));

        $this->assertEquals(count($data), $collection->count());
        $this->assertInstanceOf('\ArrayIterator', $collection->getIterator());
        $this->assertInstanceOf('\Choccybiccy\HumanApi\Model', $collection->current());

    }

    /**
     * Test fetchResults
     */
    public function testFetchResults()
    {

        $accessToken = "testAccessToken";
        $url = "test";
        $params = array("limit" => 5);
        $endpoint = $this->getMockEndpoint(array("get", "buildCollection"));

        $result = array("id" => 1, "exampleKey" => "Test");

        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->setMethods(array("getBody"))
            ->getMockForAbstractClass();

        $response->expects($this->once())
            ->method("getBody")
            ->willReturn(json_encode($result));

        $this->setProtectedProperty($endpoint, "method", "get");
        $this->setProtectedProperty($endpoint, "accessToken", $accessToken);
        $this->setProtectedProperty($endpoint, "listReturnsArray", false);

        $query = array_merge(
            array(
                "access_token" => $accessToken,
            ),
            $params
        );

        $endpoint->expects($this->once())
            ->method("get")
            ->with($url, array("query" => $query))
            ->willReturn($response);
        $endpoint->expects($this->once())
            ->method("buildCollection")
            ->with(array($result));

        $this->runProtectedMethod($endpoint, "fetchResults", array($url, $params));

    }
}
