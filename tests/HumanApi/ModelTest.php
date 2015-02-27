<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Model;

/**
 * Class ModelTest
 * @package Choccybiccy\HumanApi
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    protected $data = array(
        "firstname" => "Test",
        "lastname" => "McTest",
    );

    /**
     * Get mock model
     *
     * @param array|null $methods
     * @param \Choccybiccy\HumanApi\Endpoint|null $endpoint
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockModel($methods = null, $endpoint = null)
    {
        if(!$endpoint) {
            $endpoint = $this->getMockEndpoint();
        }
        return $this->getMockBuilder('Choccybiccy\HumanApi\Model')
            ->setConstructorArgs(array($this->data, $endpoint))
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Get mock endpoint
     *
     * @param array|null $methods
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
     * Test get
     */
    public function testGet()
    {
        $model = $this->getMockModel();
        $this->assertEquals($this->data['firstname'], $model->get("firstname"));
        $this->assertNull($model->get("doesntexist"));
    }

    /**
     * Test __call proxies to get
     */
    public function testCall()
    {
        $model = $this->getMockModel();
        $this->assertEquals($this->data['firstname'], $model->getFirstname());
    }

    /**
     * Test all
     */
    public function testAll()
    {
        $model = $this->getMockModel();
        $this->assertEquals($this->data, $model->all());
    }

    /**
     * Test get endpoint returns endpoint
     */
    public function testGetEndpoint()
    {
        $endpoint = $this->getMockEndpoint();
        $model = $this->getMockModel(null, $endpoint);
        $this->assertEquals($endpoint, $model->getEndpoint());
    }
}