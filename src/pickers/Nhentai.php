<?php


namespace ws\utils\pickers;


class Nhentai extends BaseSpider
{
    public function getItem()
    {
        $item = new BaseItem();
        $item->title = trim($this->xQueryText('//div[@id="info"]/h2/text()'));
        $node_imgs = $this->getXPath()->query('//div[@id="thumbnail-container"]//img[@class="lazyload"]');
        foreach ($node_imgs as $ni) {
            /* @var \DOMElement $ni */
            $link_t = $ni->getAttribute('data-src');
            $link = str_replace('t.nhentai', 'i.nhentai', $link_t);
            $item->resources[] = str_replace('t.jpg', '.jpg', $link);
        }
        return $item;
    }
}