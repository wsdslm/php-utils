<?php

namespace ws\utils\pickers;

use ws\utils\helpers\CommonHelper;

class GetchuSoft extends BaseSpider
{
    public function getItem()
    {
        $item = new GetchuSoftItem();
        $item->cover = $this->getPath($this->xQueryText('//table[@id="soft_table"]//a[1]/@href'));
        if ($item->cover)
            $item->resources[] = $this->getAbsUrl($item->cover);
        $item->title = trim($this->xQueryText('//h1[@id="soft-title"]/text()'));
        $brand_link = $this->xQueryText('//td[text()="ブランド："]/../td[2]/nobr/a/@href');
        $item->brand = array(
            'id' => CommonHelper::getParamValue($brand_link, 'search_brand_id'),
            'name' => trim($this->xQueryText('//td[text()="ブランド："]/../td[2]/a'))
        );
        $item->price = trim($this->xQueryText('//td[text()="定価："]/../td[2]'));
        $item->release_date = trim($this->xQueryText('//td[text()="発売日："]/../td[2]'));
        $item->media = trim($this->xQueryText('//td[text()="メディア："]/../td[2]'));
        $item->jan_code = trim($this->xQueryText('//td[text()="JANコード："]/../td[2]'));
        $item->part_number = trim($this->xQueryText('//td[text()="品番："]/../td[2]'));
        $item->duration = trim($this->xQueryText('//td[text()="時間："]/../td[2]'));
        $item->scenario = trim($this->xQueryText('//td[text()="シナリオ："]/../td[2]'));
        $item->illustrator = trim($this->xQueryText('//td[text()="原画："]/../td[2]'));
        $item->character_design = trim($this->xQueryText('//td[text()="キャラデザイン："]/../td[2]'));
        $item->music = trim($this->xQueryText('//td[text()="音楽："]/../td[2]'));
        $item->director = trim($this->xQueryText('//td[text()="監督："]/../td[2]'));
        $item->artist = trim($this->xQueryText('//td[text()="アーティスト："]/../td[2]'));
        foreach ($this->getXPath()->query('//td[contains(text(),"サブジャンル")]/../td[2]/a[position()<last()]') as $node) {
            /* @var \DOMElement $node */
            $sub_genre_link = $node->getAttribute('href');
            $item->sub_genres[] = array(
                'id' => CommonHelper::getParamValue($sub_genre_link, 'sub_genre_id'),
                'name' => $node->textContent,
            );
        }
        foreach ($this->getXPath()->query('//ul[@class="list-sub"]/li') as $node) {
            /* @var \DOMElement $node */
            $item->game_spec[] = $node->nodeValue;
        }
        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"商品説明")]/following-sibling::div[1]');
        $item->item_description = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"商品紹介")]/following-sibling::div[1]');
        $item->product_introduction = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"あらすじ")]/following-sibling::div[1]');
        $item->synopsis = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"ゲーム概要")]/following-sibling::div[1]');
        $item->game_outline = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"ストーリー")]/following-sibling::div[1]');
        $item->story = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"キャラクター")]/following-sibling::table[1]');
        $item->character = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $node = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"収録曲")]/following-sibling::div[1]');
        $item->track_list = $this->getNodeHtml($node);
        $item->resources = array_merge($item->resources, $this->getResources($node));

        $item->staff_cast = $this->xQueryHtml('//div[contains(@class,"tabletitle") and contains(text(),"スタッフ／キャスト")]/following-sibling::div[1]');
        foreach ($this->getXPath()->query('//div[contains(@class,"tabletitle") and contains(text(),"サンプル画像")]/following-sibling::div[1]//a') as $node) {
            /* @var \DOMElement $node */
            $path = $this->getPath($node->getAttribute('href'));
            $item->sample_images[] = $path;
        }
        $node_sample_images = $this->getNode('//div[contains(@class,"tabletitle") and contains(text(),"サンプル画像")]/following-sibling::div[1]');
        $item->resources = array_merge($item->resources, $this->getResources($node_sample_images));
        return $item;
    }
}