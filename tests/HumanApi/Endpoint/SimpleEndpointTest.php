<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class SimpleEndpointTest
 * @package Choccybiccy\HumanApi\Endpoint
 */
class SimpleEndpointTest extends \PHPUnit_Framework_TestCase
{

    use ReflectionMethods;

    /**
     * Test build list url
     */
    public function testBuildListUrl()
    {

        $simple = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\SimpleEndpoint')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($simple, "type");

        $simple->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type));

        $this->runProtectedMethod($simple, "buildListUrl");

    }

    /**
     * Test buildSpecificEntryUrl throws unsupported exception
     */
    public function testBuildSpecificEntryUrlThrowsUnsuportedException()
    {

        $simple = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\SimpleEndpoint')
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException('Choccybiccy\HumanApi\Endpoint\UnsupportedEndpointMethodException');
        $this->runProtectedMethod($simple, "buildSpecificEntryUrl", array(1));

    }

    /**
     * Test buildRecentUrl throws unsupported exception
     */
    public function testBuildRecentUrlThrowsUnsuportedException()
    {

        $simple = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\SimpleEndpoint')
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException('Choccybiccy\HumanApi\Endpoint\UnsupportedEndpointMethodException');
        $this->runProtectedMethod($simple, "buildRecentUrl", array(1));

    }
}