<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/17/18
 * Time: 6:52 PM
 */

// Application bootstrap sequence

require_once(__DIR__ . "/../vendor/autoload.php");

require_once(__DIR__ . "/../config/config.php");

$container = new \Slim\Container;
$app = new \Slim\App($container);

$settings = $container->get('settings');
$settings->replace($config);

require_once(__DIR__ . "/../config/di.php");

require_once(__DIR__ . "/../config/routes.php");

$app->run();
