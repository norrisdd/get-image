<?php
/**
 * Created by PhpStorm.
 * User: danieln
 * Date: 9/17/18
 * Time: 7:32 PM
 */

namespace GetImage;

use PHPHtmlParser\Dom;

class ImageGrabber
{
    protected $dom;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
        $dom->setOptions([]);
    }

    public function grabImages($url)
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