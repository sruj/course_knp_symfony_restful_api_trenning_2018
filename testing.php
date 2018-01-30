<?php
require __DIR__ . '/vendor/autoload.php';
$client = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost',
    'defaults' => [
        'exceptions' => false
    ]
]);

$debuggingQuerystring = '';
if (isset($_GET['XDEBUG_SESSION_START'])) { // xdebug
    $debuggingQuerystring = 'XDEBUG_SESSION_START=' . $_GET['XDEBUG_SESSION_START'];
}
if (isset($_COOKIE['XDEBUG_SESSION'])) { // xdebug (cookie)
    $debuggingQuerystring = 'XDEBUG_SESSION_START=PHPSTORM';
}
if (isset($_GET['start_debug'])) { // zend debugger
    $debuggingQuerystring = 'start_debug=' . $_GET['start_debug'];
}
if (empty($debuggingQuerystring)) {
    $debuggingQuerystring = 'XDEBUG_SESSION_START=PHPSTORM';
}


$nickname = 'ObjectOrienter' . rand(0, 999);
$data = array(
    'nickname' => $nickname,
    'avatarNumber' => 5,
    'tagLine' => 'a test dev3!'
);

// 1) Create a programmer resource
//$response = $client->post('/knp_Symfony_RESTful_API_Trenning_2018/web/app_dev.php/api/programmers', [
//    'body' => json_encode($data)
//]);





//testValidationErrors
$data = array(
    'avatarNumber' => 2,
    'tagLine' => 'I\'m from a test!'
);
$response = $client->post('/knp_Symfony_RESTful_API_Trenning_2018/web/app_dev.php/api/programmers' . '?' . $debuggingQuerystring, [
    'body' => json_encode($data)
]);





//$programmerUrl = $response->getHeader('Location');
//// 2) GET a programmer resource
//$response = $client->get($programmerUrl);
//
// 3) GET a programmers collection resource
//$response = $client->get('/knp_Symfony_RESTful_API_Trenning_2018/web/app_dev.php/api/programmers/' . '?' . $debuggingQuerystring);
$response = $client->get('/knp_Symfony_RESTful_API_Trenning_2018/web/app_dev.php/api/programmers');

echo $response;
echo "\n\n";

