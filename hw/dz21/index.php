<?php

define('SYSTEM_DIR', __DIR__ . '/system/');
define('CONTROLLERS_DIR', __DIR__ . '/controllers/');
define('VIEWS_DIR', __DIR__ . '/views/');
define("INDEX_PHP", str_replace('/var/www/html', '', __FILE__));


require_once __DIR__ . '/utils/render.php';
require_once __DIR__ . '/utils/functions.php';
require_once __DIR__ . '/traits/Validator.php';
require_once SYSTEM_DIR . 'View.php';
require_once SYSTEM_DIR . 'Router.php';
require_once SYSTEM_DIR . 'Request.php';
require_once CONTROLLERS_DIR . 'GreetingsController.php';
require_once CONTROLLERS_DIR . 'CalcController.php';

$router = new Router();
$router->addRouter('/greetings', [
    'get' => "GreetingsController@greetings",
]);

$router->addRouter('/calculate', [
    'get' => "CalcController@showForm",
    'post' => "CalcController@showResult"
]);

try {
    $router->processRouter(Request::getUrl(), Request::getMethod());
} catch (Exception $error) {
    print_r($error->getMessage());
}