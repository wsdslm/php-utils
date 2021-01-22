<?php


namespace ws\utils\tasks;


use ws\utils\pickers\BaseSpider;

class Wii91 extends DzX3Base
{
    public $base_url = 'https://www.91wii.com/';
    public $sign_form_url = '/plugin.php?id=dc_signin:sign';
    public $sign_submit_url = '/plugin.php?id=dc_signin:sign';

    public function run()
    {
        $xpath = new BaseSpider($this->sign_form_url, $this->client);
        $formhash = $xpath->getNode('//form[@id="signform"]/input[1]')->getAttribute('value');
        $data = [
            'formhash' => $formhash,
            'signsubmit' => 'yes',
            'handlekey' => 'signin',
            'emotid' => '1',
            'referer' => 'https://www.91wii.com/plugin.php?id=dc_signin',
            'content' => 'signin at ' . date('Y-m-d H:i:s'),
            'signpn' => true,
        ];
        $this->client->post($this->sign_submit_url, [
            'body' => $data
        ]);
    }
}