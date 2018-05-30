<?php

namespace Choccybiccy\HumanApi\Endpoint;

use Choccybiccy\HumanApi\Traits\ReflectionMethods;

/**
 * Class LocationsTest
 * @package Choccybiccy\HumanApi\Endpoint
 */
class LocationsTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionMethods;

    /**
     * Test build specific entry url
     */
    public function testBuildSpecificEntryUrl()
    {

        $locations = $this->getMockBuilder('Choccybiccy\HumanApi\Endpoint\Locations')
            ->setMethods(array("buildUrlParts"))
            ->disableOriginalConstructor()
            ->getMock();
        $type = $this->getProtectedProperty($locations, "type");
        $id = 1;

        $locations->expects($this->once())
            ->method("buildUrlParts")
            ->with(array($type, $id));

        $this->runProtectedMethod($locations, "buildSpecificEntryUrl", array($id));

    }
}
