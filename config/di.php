<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/18/18
 * Time: 8:26 PM
 */

// Pimple-compatible class setup definitions, required directly inside index.php

$container[\GetImage\Controller::class] = function($container) {
    return new \GetImage\Controller($container);
};

$container[Twig_Environment::class] = function($container) {
    $twigLoader = new \Twig_Loader_Filesystem(__DIR__ . "/../view");
    return new \Twig_Environment($twigLoader, []);
};

$container[\PHPHtmlParser\Dom::class] = function($container) {
    return new PHPHtmlParser\Dom();
};

$container[\GetImage\ImageGrabber::class] = function($container) {
    return new \GetImage\ImageGrabber($container->get(PHPHtmlParser\Dom::class));
};
