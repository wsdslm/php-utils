<?php
require __DIR__ . '/vendor/autoload.php';

use ws\utils\helpers\CommonHelper;
use ws\utils\helpers\IDM;
use ws\utils\pickers\YandeReApi;

// php yande-re.php <tags> <min_page> <max_page>

$tags = $argv[1];
$min_page = $argv[2];
$max_page = $argv[3];


$conf = require(__DIR__ . '/pick.conf.php');
$path = $conf['yande_re_path'];
$client = new \GuzzleHttp\Client(['defaults' => [
    'verify' => false
]]);
for ($i = $min_page; $i <= $max_page; $i++) {
    $yr = new YandeReApi($tags, $i, null, $client);
    $items = $yr->getItems();
    foreach ($items as $item) {
        $filename = urldecode(CommonHelper::handlePath(basename($item->file_url)));
        if (file_exists($path . '/' . $filename))
            continue;
        IDM::add_file($item->file_url, $filename, $path);
    }
}