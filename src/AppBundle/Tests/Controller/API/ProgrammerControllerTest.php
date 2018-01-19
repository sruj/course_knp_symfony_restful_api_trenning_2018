<?php
/**
 * Created by PhpStorm.
 * User: chiny
 * Date: 2018-01-19
 * Time: 11:22
 */

namespace AppBundle\Tests\Controller\API;

use AppBundle\Controller\Api\ProgrammerController;
use AppBundle\Test\ApiTestCase;

class ProgrammerControllerTest extends ApiTestCase
{
    public function testPOST()
    {

//        $debuggingQuerystring = '';
//        if (isset($_GET['XDEBUG_SESSION_START'])) { // xdebug
//            $debuggingQuerystring = 'XDEBUG_SESSION_START=' . $_GET['XDEBUG_SESSION_START'];
//        }
//        if (isset($_COOKIE['XDEBUG_SESSION'])) { // xdebug (cookie)
//            $debuggingQuerystring = 'XDEBUG_SESSION_START=PHPSTORM';
//        }
//        if (isset($_GET['start_debug'])) { // zend debugger
//            $debuggingQuerystring = 'start_debug=' . $_GET['start_debug'];
//        }
//        if (empty($debuggingQuerystring)) {
//            $debuggingQuerystring = 'XDEBUG_SESSION_START=PHPSTORM';
//        }
        $debuggingQuerystring = '';

        $nickname = 'ObjectOrienter' . rand(0, 999);
        $data = array(
            'nickname' => $nickname,
            'avatarNumber' => 5,
            'tagLine' => 'a test dev!'
        );

        $response = $this->client->post('/knp_Symfony_RESTful_API_Trenning_2018/web/app_dev.php/api/programmers' . '?' . $debuggingQuerystring, [
            'body' => json_encode($data)
        ]);
        $header = $response->getHeaders();
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertGreaterThan(0, $header['Content-Length'][0]);
        $body = $response->getBody();
        $this->assertArrayHasKey('nickname', json_decode($body, true));//true by był array zamiast obiektu
    }

}
