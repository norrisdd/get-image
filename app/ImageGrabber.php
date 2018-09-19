<?php
/**
 * Created by PhpStorm.
 * User: Daniel Norris
 * Date: 9/17/18
 * Time: 7:32 PM
 */

namespace GetImage;

use PHPHtmlParser\Dom;

/**
 * Class ImageGrabber
 *
 * A service for grabbing images from the DOM of a given URL. Javascript DOM manipulation is not taken into consideration.
 *
 * @package GetImage
 */
class ImageGrabber
{
    /**
     * @var Dom $dom Used to load the HTML of a given URL as a manipulable DOM
     */
    protected $dom;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
        $dom->setOptions([]);
    }

    /**
     * Loads the DOM of a given URL's HTML, then finds all <img> and <picture><source>...</picture> elements on the page
     * and grabs the URLs for those image files and returns them as an array.
     *
     * Note: Javascript manipulation of DOM to insert images will not be reflected.
     *
     * @param string $url
     * @return array An array of URLs for image resources identified.
     */
    public function grabImages($url) : array
    {
        $results = [];

        $this->dom->load($url);

        $images = $this->dom->find('img');

        $pictures = $this->dom->find('picture source');

        foreach($images as $image) {
            array_push($results, $image->getAttribute('src'));
        }

        foreach($pictures as $picture) {
            array_push($results, $picture->getAttribute('srcset'));
        }

        return $results;
    }
}