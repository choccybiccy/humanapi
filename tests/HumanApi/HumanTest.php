<?php

namespace Choccybiccy\HumanApi;

use Choccybiccy\HumanApi\Human;

/**
 * Class HumanTest
 * @package Choccybiccy\HumanApi
 */
class HumanTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test constructor
     */
    public function testConstructor()
    {
        $token = "token";
        $human = new Human($token);
        $this->assertEquals($token, $human->getAccessToken());
    }
}
