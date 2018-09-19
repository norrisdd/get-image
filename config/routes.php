<?php
/**
 * Created by PhpStorm.
 * User: danieln
 * Date: 9/18/18
 * Time: 9:13 PM
 */

// Slim routes

$app->post('/result', \GetImage\Controller::class . ":result");
$app->any('/', \GetImage\Controller::class . ":home");
