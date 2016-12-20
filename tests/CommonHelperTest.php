<?php

use ws\utils\helpers\CommonHelper;

class CommonHelperTest extends PHPUnit_Framework_TestCase
{
    public function testGetParamValue()
    {
        $url = './php/nsearch.phtml?search_brand_id=10023';
        self::assertEmpty(CommonHelper::getParamValue($url, 'brand_id'));
        self::assertEquals(10023, CommonHelper::getParamValue($url, 'search_brand_id'));
    }
}