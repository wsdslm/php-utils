<?php

use ws\utils\tasks\Djgame;
use ws\utils\tasks\HostLoc;
use ws\utils\tasks\Tsdm;
use ws\utils\tasks\Wii91;

class TaskTest extends PHPUnit_Framework_TestCase
{
    public $conf = [];

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->conf = require(__DIR__ . '/../task.conf.php');
    }

    public function testHostLoc()
    {
        $cookie = $this->conf['hostloc_cookie'];
        $task = new HostLoc($cookie);
        $task->run();
    }

    public function testWii91()
    {
        $cookie = $this->conf['wii91_cookie'];
        $task = new Wii91($cookie);
        $task->run();
    }

    public function testDjgame()
    {
        $cookie = $this->conf['djgame_cookie'];
        $task = new Djgame($cookie);
        $task->run();
    }

    public function testTsdm()
    {
        $cookie = $this->conf['tsdm_cookie'];
        $task = new Tsdm($cookie);
        $task->run();
    }
}
