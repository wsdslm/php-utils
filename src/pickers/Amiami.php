<?php


namespace ws\utils\pickers;


class Amiami extends BaseSpider
{
    public $img = false;

    public function getItem()
    {
        $item = new BaseItem();
        $item->title = $this->xQueryText('//meta[@property="og:title"]/@content');
        $node = $this->getNode('//p[@id="gallery"]');
        $item->resources = $this->getResources($node, $this->img);
        return $item;
    }
}