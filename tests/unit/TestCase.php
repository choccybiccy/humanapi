<?php

namespace Choccybiccy\HumanApi;

/**
 * Class TestCase
 * @package Choccybiccy\HumanApi
 */
class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * Get mock model
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockModel($methods = null)
    {
        return $this->getMockBuilder('\Choccybiccy\HumanApi\Model')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Get mock human
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockHuman($methods = null)
    {
        return $this->getMockBuilder('\Choccybiccy\HumanApi\Human')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Get mock endpoint
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockEndpoint($methods = null)
    {
        return $this->getMockBuilder('\Choccybiccy\HumanApi\Endpoint')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Get mock collection
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockCollection($methods = null)
    {
        return $this->getMockBuilder('\Choccybiccy\HumanApi\Collection')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

}