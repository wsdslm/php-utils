<?php


namespace ws\utils\pickers;


class ToyNavi extends BaseSpider
{
    public $img = false;

    public function getItem()
    {
        $item = new BaseItem();
        $item->title = trim($this->xQueryText('//meta[@name="description"]/@content'));
        $article = $this->getNode('//article[@id="entrybody"]');
        $article->removeChild($this->getNode('//span[@id="headbtns"]'));
        $article->removeChild($this->getNode('//div[@id="shoplinks"]'));
        $item->resources = $this->getResources($article, $this->img);
        return $item;
    }
}