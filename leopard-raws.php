<?php
require 'vendor/autoload.php';
use ws\utils\pickers\LeopardRawsPicker;

$conf = require('leopard-raws.conf.php');
$picker = new LeopardRawsPicker($conf);
$picker->pick();
