<?php

namespace Choccybiccy\HumanApi\Endpoint;

/**
 * Class LocationsTest
 * @package Choccybiccy\HumanApi\Endpoint
 */
class LocationsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test build specific entry url
     */
    public function testBuildSpecificEntryUrl()
    {

        $locations = $this->getMock('Choccybiccy\HumanApi\Endpoint\Locations');
        $type = $this->getProtectedProperty($locations, "type");
        $id = 1;

        $locations->expects($this->once())
            ->method("buildUrlParts")
            ->with($type, $id);

        $this->runProtectedMethod($locations, "buildSpecificEntryUrl", array($id));

    }
}