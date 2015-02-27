<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class PeriodicEndpointTest
 * @package Choccybiccy\HumanApi\Endpoint
 */
class PeriodicEndpointTest extends \PHPUnit_Framework_TestCase
{

    use ReflectionMethods;

    /**
     * Test build specific entry url
     */
    public function testBuildSpecificEntryUrl()
    {

        $periodic = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\PeriodicEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($periodic, "type");
        $id = 1;

        $periodic->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type, $id));

        $this->runProtectedMethod($periodic, "buildSpecificEntryUrl", array($id));

    }

    /**
     * Test build list url
     */
    public function testBuildListUrl()
    {

        $periodic = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\PeriodicEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($periodic, "type");

        $periodic->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type));

        $this->runProtectedMethod($periodic, "buildListUrl");

    }

    /**
     * Test build recent url
     */
    public function testBuildRecentUrl()
    {

        $periodic = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\PeriodicEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($periodic, "type");
        $plural = $this->getProtectedProperty($periodic, "plural");

        $periodic->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type, $plural));

        $this->runProtectedMethod($periodic, "buildRecentUrl");

    }
}