<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/18/18
 * Time: 9:13 PM
 */

// Slim Framework routes, required directly inside index.php

$app->post('/result', \GetImage\Controller::class . ":result");
$app->any('/', \GetImage\Controller::class . ":home");
