<?php


namespace ws\utils\tasks;


use ws\utils\pickers\BaseSpider;

class Tsdm extends DzX3Base
{
    public $base_url = 'https://www.tsdm39.net/';
    public $sign_form_url = '/plugin.php?id=dsu_paulsign:sign';
    public $sign_submit_url = '/plugin.php?id=dsu_paulsign:sign&operation=qiandao&infloat=1&inajax=1';

    public function run()
    {
        $xpath = new BaseSpider($this->sign_form_url, $this->client);
        $formhash = $xpath->getNode('//form[@id="qiandao"]/input[1]')->getAttribute('value');
        $data = [
            'formhash' => $formhash,
            'qdxq' => 'yl',
            'qdmode' => 1,
            'todaysay' => 'signin at ' . date('Y-m-d H:i:s'),
            'fastreply' => '1',
        ];
        $this->client->post($this->sign_submit_url, [
            'body' => $data
        ]);
    }
}