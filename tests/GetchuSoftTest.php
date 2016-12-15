<?php

use ws\utils\pickers\GetchuSoft;

class GetchuSoftTest extends PHPUnit_Framework_TestCase
{
    public function testMain()
    {
        $url = 'http://www.getchu.com/soft.phtml?id=916600';
        $gc = new GetchuSoft($url);
        $item = $gc->getItem();
        self::assertEquals('きんいろモザイク Blu-ray BOX', $item->title);
        self::assertEquals('メディアファクトリー', $item->brand);
        self::assertEquals('￥20,000 (税込￥21,600)', $item->price);
        self::assertEquals('2016/11/25', $item->release_date);
        self::assertEquals('BD-VIDEO 3枚組', $item->media);
        self::assertEquals('4935228162024', $item->jan_code);
        self::assertEquals('ZMAZ-10884', $item->part_number);
        self::assertEquals('本編約284分＋特典映像', $item->duration);
        self::assertEquals('植田和幸', $item->character_design);
        self::assertEquals('川田瑠夏', $item->music);
        self::assertEquals('天衝', $item->director);
        self::assertCount(2, $item->sub_genres);
        self::assertEquals('BD-BOX・DVD-BOX', $item->sub_genres[0]);
        self::assertEquals('コミック原作アニメ', $item->sub_genres[1]);
        self::assertContains('映像特典', $item->product_introduction);
        self::assertContains('日英美少女ゆるふわ学園コメディ、はじまるよ！', $item->story);
        self::assertContains('原悠衣', $item->staff_cast);
        self::assertCount(7, $item->sample_images);
    }
}