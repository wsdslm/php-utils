<?php


namespace ws\utils\pickers;


class Moeyo extends BaseSpider
{
    public $img = false;

    public function getItem()
    {
        $item = new BaseItem();
        $item->title = trim($this->xQueryText('//h1[contains(@class,"title")]'));
        $article = $this->getNode('//div[@itemprop="articleBody"]');
        $item->resources = $this->getResources($article, $this->img);
        return $item;
    }
}