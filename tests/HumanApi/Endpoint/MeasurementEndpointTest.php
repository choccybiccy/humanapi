<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class MeasurementEndpointTest
 * @package Choccybiccy\HumanApi\Endpoint
 */
class MeasurementEndpointTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionMethods;

    /**
     * Test build specific entry url
     */
    public function testBuildSpecificEntryUrl()
    {

        $measurement = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\MeasurementEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($measurement, "type");
        $plural = $this->getProtectedProperty($measurement, "plural");
        $id = 1;

        $measurement->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type, $plural, $id));

        $this->runProtectedMethod($measurement, "buildSpecificEntryUrl", array($id));

    }

    /**
     * Test build list url
     */
    public function testBuildListUrl()
    {

        $measurement = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\MeasurementEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($measurement, "type");
        $plural = $this->getProtectedProperty($measurement, "plural");

        $measurement->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type, $plural));

        $this->runProtectedMethod($measurement, "buildListUrl");

    }

    /**
     * Test build recent url
     */
    public function testBuildRecentUrl()
    {

        $measurement = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\MeasurementEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($measurement, "type");

        $measurement->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type));

        $this->runProtectedMethod($measurement, "buildRecentUrl");

    }
}
