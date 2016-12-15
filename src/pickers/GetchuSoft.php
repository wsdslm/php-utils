<?php
namespace ws\utils\pickers;

class GetchuSoft extends BaseSpider
{
    public function getItem()
    {
        $item = new GetchuSoftItem();
        $item->title = trim($this->xQueryText('//h1[@id="soft-title"]/text()'));
        $item->brand = trim($this->xQueryText('//td[text()="ブランド："]/../td[2]/a'));
        $item->price = trim($this->xQueryText('//td[text()="定価："]/../td[2]'));
        $item->release_date = trim($this->xQueryText('//td[text()="発売日："]/../td[2]'));
        $item->media = trim($this->xQueryText('//td[text()="メディア："]/../td[2]'));
        $item->jan_code = trim($this->xQueryText('//td[text()="JANコード："]/../td[2]'));
        $item->part_number = trim($this->xQueryText('//td[text()="品番："]/../td[2]'));
        $item->duration = trim($this->xQueryText('//td[text()="時間："]/../td[2]'));
        $item->character_design = trim($this->xQueryText('//td[text()="キャラデザイン："]/../td[2]'));
        $item->music = trim($this->xQueryText('//td[text()="音楽："]/../td[2]'));
        $item->director = trim($this->xQueryText('//td[text()="監督："]/../td[2]'));
        foreach ($this->getXPath()->query('//td[contains(text(),"サブジャンル")]/../td[2]/a[position()<last()]') as $node) {
            $item->sub_genres[] = $node->textContent;
        }
        $item->product_introduction = $this->xQueryHtml('//div[@class="tabletitle" and contains(text(),"商品紹介")]/following-sibling::div[1]');
        $item->story = $this->xQueryHtml('//div[@class="tabletitle" and contains(text(),"ストーリー")]/following-sibling::div[1]');
        $item->staff_cast = $this->xQueryHtml('//div[@class="tabletitle" and contains(text(),"スタッフ／キャスト")]/following-sibling::div[1]');
        foreach ($this->getXPath()->query('//div[@class="tabletitle" and contains(text(),"サンプル画像")]/following-sibling::div[1]//a') as $node) {
            /* @var \DOMElement $node */
            $item->sample_images[] = $node->getAttribute('href');
        }
        return $item;
    }
}