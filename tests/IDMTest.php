<?php
use ws\utils\helpers\IDM;

class IDMTest extends PHPUnit_Framework_TestCase
{
    // 仅提供url
    public function testUrl()
    {
        $url = 'https://files.yande.re/image/07c107dfa37157f2c9996dd7767f1f95/yande.re%20358736%20breast_hold%20cleavage%20d.va%20duji_amo%20megane%20mei_%28overwatch%29%20overwatch%20school_swimsuit%20swimsuits%20wet_clothes.png';
        IDM::add_file($url);
    }

    // 提供url和filename
    public function testFilename()
    {
        $url = 'https://assets.yande.re/data/preview/d1/93/d1935d3aad128143bcb98fe6b2937f3a.jpg';
        $filename = 'newname.png';
        IDM::add_file($url, $filename);
    }

    // 提供url和save_path
    public function testSavePath()
    {
        $url = 'https://assets.yande.re/data/preview/92/bb/92bbc7b0e01362f82d16ae3910afd9ed.jpg';
        $save_path = __DIR__ . '/tmp';
        IDM::add_file($url, '', $save_path);
    }

    // 提供url,filename,save_path
    public function testAll()
    {
        $url = 'https://files.yande.re/image/4b6bdb5012db9754b39e4dcf297f3dd1/yande.re%20358754%20toranoana%20usatsuka_eiji.png';
        $filename = 'newname2.png';
        $save_path = __DIR__ . '/tmp';
        IDM::add_file($url, $filename, $save_path);
    }
}
