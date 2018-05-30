<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Model;

/**
 * Class ModelTest
 * @package Choccybiccy\HumanApi
 */
class ModelTest extends \PHPUnit\Framework\TestCase
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
     * @param \Choccybiccy\HumanApi\Api|null $api
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockModel($methods = null, $api = null)
    {
        if (!$api) {
            $api = $this->getMockApi();
        }
        return $this->getMockBuilder('Choccybiccy\HumanApi\Model')
            ->setConstructorArgs(array($this->data, $api))
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Get mock endpoint
     *
     * @param array|null $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockApi($methods = array())
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
    public function testGetApi()
    {
        $api = $this->getMockApi();
        $model = $this->getMockModel(null, $api);
        $this->assertEquals($api, $model->getApi());
    }
}
