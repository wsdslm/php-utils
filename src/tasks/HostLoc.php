<?php


namespace ws\utils\tasks;


class HostLoc extends DzX3Base
{
    public $base_url = 'https://www.hostloc.com/';

    public function run()
    {
        for ($i = 1000; $i < 1030; $i++) {
            $this->client->get('/home.php?mod=space&uid=' . $i);
            sleep(1);
        }
    }
}