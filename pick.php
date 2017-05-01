<?php
require __DIR__ . '/vendor/autoload.php';

use ws\utils\helpers\CommonHelper;
use ws\utils\helpers\IDM;
use ws\utils\pickers\Amiami;
use ws\utils\pickers\ToyNavi;

$conf = require(__DIR__ . '/pick.conf.php');

while (true) {
    echo "input url:";
    $input = trim(fgets(STDIN));
    if ($input == 'quit' || $input == 'exit' || $input == 'q')
        break;
    if (!filter_var($input, FILTER_VALIDATE_URL)) {
        echo "invalid url!\n";
        break;
    }
    $item = null;
    $download_path = '';
    if (stripos($input, 'amiami.jp') !== false) {
        $item = (new Amiami($input))->getItem();
        $download_path = $conf['amiami_path'] . '/' . CommonHelper::handlePath($item->title);
    } elseif (stripos($input, 'toy-navi.net') !== false) {
        $item = (new ToyNavi($input))->getItem();
        $download_path = $conf['toy_navi_path'] . '/' . CommonHelper::handlePath($item->title);
    } else {
        echo "invalid url!\n";
        break;
    }

    if (!file_exists($download_path)) {
        mkdir($download_path);
    }
    foreach ($item->resources as $image) {
        IDM::add_file($image, '', $download_path);
    }
}