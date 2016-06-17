<?php
namespace ws\utils\pickers;

class LeopardRawsRss
{
    public $title;
    /**
     * @var LeopardRawsRssItem[]
     */
    public $items = [];

    public function __construct($rss_url)
    {
        $xml = simplexml_load_file($rss_url);
        $this->title = $xml->channel->title;
        foreach ($xml->channel->item as $item) {
            $rssItem = new LeopardRawsRssItem();
            $rssItem->title = strval($item->title);
            $rssItem->link = strval($item->link);
            $rssItem->guid = strval($item->guid);
            $rssItem->description = strval($item->description);
            $rssItem->pubDate = strval($item->pubDate);
            array_push($this->items, $rssItem);
        }
    }
}
