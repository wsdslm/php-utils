<?php
use ws\utils\helpers\IDM;

class IDMTest extends PHPUnit_Framework_TestCase
{
    public function testAddFile()
    {
        // 仅提供url
        $url = 'https://files.yande.re/image/07c107dfa37157f2c9996dd7767f1f95/yande.re%20358736%20breast_hold%20cleavage%20d.va%20duji_amo%20megane%20mei_%28overwatch%29%20overwatch%20school_swimsuit%20swimsuits%20wet_clothes.png';
        IDM::add_file($url);

        // 提供url和filename
        $url = 'https://files.yande.re/image/2a9878696d6ed7d60b2e7eec994714b0/yande.re%20358755%20omega_2-d%20toranoana.png';
        $filename = 'newname.png';
        IDM::add_file($url, $filename);

        // 提供url,filename,save_path
        $url = 'https://files.yande.re/image/4b6bdb5012db9754b39e4dcf297f3dd1/yande.re%20358754%20toranoana%20usatsuka_eiji.png';
        $filename = 'newname2.png';
        $save_path = __DIR__ . '/tmp';
        IDM::add_file($url, $filename, $save_path);
    }
}
