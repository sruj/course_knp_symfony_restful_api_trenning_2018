<?php
/**
 * Created by PhpStorm.
 * User: chiny
 * Date: 2018-01-19
 * Time: 11:22
 */

namespace AppBundle\Test;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    private static $staticClient;
    protected $client;

    static public function setUpBeforeClass()
    {
        self::$staticClient = new \GuzzleHttp\Client([
            'base_url' => 'http://localhost',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;
    }
}
