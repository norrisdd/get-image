<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/18/18
 * Time: 7:34 PM
 */

namespace GetImage;

use PHPHtmlParser\Exceptions\CurlException;
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
    /**
     * @var \Twig_Environment $view The view renderer
     */
    protected $view;

    /**
     * @var ImageGrabber $imageGrabber Service for grabbing images from given URLs
     */
    protected $imageGrabber;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get(\Twig_Environment::class);
        $this->imageGrabber = $container->get(ImageGrabber::class);
    }

    /**
     * Action "home" of main controller. Displays the initial page view.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface The modified PSR-7 compliant response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home(RequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        $body = $response->getBody();
        $body->write($this->view->render('base.html'));

        return $response;
    }

    /**
     * Action "result" of main controller. A POST request is made against this action and it invokes the service to grab
     * the image URLs from the target page if possible, else returning an error message.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface The modified PSR-7 compliant response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function result(RequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        $targetUrl = $request->getParsedBodyParam('targetUrl', false); // retrieve POST request variable targetUrl
        $error = "";
        $results = [];

        if (filter_var($targetUrl, FILTER_VALIDATE_URL) === false) {
            // try to prepend http scheme and retest. If it fails again targetUrl gets set to false.
            $targetUrl = filter_var("http://" . $targetUrl, FILTER_VALIDATE_URL);
        }

        if ($targetUrl !== false) {
            try {
                $results = $this->imageGrabber->grabImages($targetUrl);
            }
            catch(CurlException $e) {
                $error = $e->getMessage();
            }
        }
        else {
            $error = "Given URL was unable to be validated.";
        }

        $body = $response->getBody();
        $body->write($this->view->render('base.html', [
            'targetUrl' => $targetUrl,
            'results' => $results,
            'error' => $error
        ]));

        return $response;
    }
}
