<?php
/**
 * Created by PhpStorm.
 * User: danieln
 * Date: 9/18/18
 * Time: 7:34 PM
 */

namespace GetImage;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Controller
 *
 * Simple class acting as the overall controller for the sample application.
 *
 * @package GetImage
 */
class Controller
{
    protected $view;
    protected $imageGrabber;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get(\Twig_Environment::class);
        $this->imageGrabber = $container->get(ImageGrabber::class);
    }

    public function home(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $body = $response->getBody();
        $body->write($this->view->render('base.html'));

        return $response;
    }

    public function result(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $targetUrl = $request->getParsedBodyParam('targetUrl', false);

        if ($targetUrl !== false) {
            $results = $this->imageGrabber->grabImages($targetUrl);
        }

        $body = $response->getBody();
        $body->write($this->view->render('base.html', ['targetUrl' => $targetUrl, 'results' => $results]));

        return $response;
    }
}
