<?php
require __DIR__ . '/vendor/autoload.php';

$conf = require(__DIR__ . '/task.conf.php');

$task_name = isset($argv[1]) ? $argv[1] : '';

switch ($task_name) {
    case 'djgame':
        $task = new \ws\utils\tasks\Djgame($conf['djgame_cookie']);
        $task->run();
        break;
    case 'tsdm':
        $task = new \ws\utils\tasks\Tsdm($conf['tsdm_cookie']);
        $task->run();
        break;
    case 'wii91':
        $task = new \ws\utils\tasks\Wii91($conf['wii91_cookie']);
        $task->run();
        break;
    case 'hostloc':
        $task = new \ws\utils\tasks\HostLoc($conf['hostloc_cookie']);
        $task->run();
        break;
};
