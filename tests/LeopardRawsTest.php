<?php
require '../vendor/autoload.php';

use ws\utils\pickers\LeopardRawsRss;

class LeopardRawsTest extends PHPUnit_Framework_TestCase
{
    public function testRss()
    {
        $url = 'http://leopard-raws.org/rss.php?search=Bishoujo+Yuugi+Unit+Crane+Game';
        $rss = new LeopardRawsRss($url);
        var_dump($rss->items);
        $this->assertGreaterThan(1, count($rss->items));
    }
}
