<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/17/18
 * Time: 6:52 PM
 */

// Application bootstrap sequence

require_once(__DIR__ . "/../vendor/autoload.php");

// load Slim Framework configuration
require_once(__DIR__ . "/../config/config.php");

$container = new \Slim\Container;
$app = new \Slim\App($container);

$settings = $container->get('settings');
$settings->replace($config);


// load container definitions
require_once(__DIR__ . "/../config/di.php");

// load web routes
require_once(__DIR__ . "/../config/routes.php");

// initialize application
$app->run();
