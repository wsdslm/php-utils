<?php

use ws\utils\pickers\GetchuSoft;

class GetchuSoftTest extends PHPUnit_Framework_TestCase
{
    public function testBD()
    {
        $url = 'http://www.getchu.com/soft.phtml?id=916600';
        $gc = new GetchuSoft($url);
        $item = $gc->getItem();
        self::assertEquals('/brandnew/916600/c916600package.jpg', $item->cover);
        self::assertEquals('きんいろモザイク Blu-ray BOX', $item->title);
        self::assertEquals('メディアファクトリー', $item->brand['name']);
        self::assertEquals(10023, $item->brand['id']);
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
        self::assertEquals('BD-BOX・DVD-BOX', $item->sub_genres[0]['name']);
        self::assertEquals(355, $item->sub_genres[0]['id']);
        self::assertEquals('コミック原作アニメ', $item->sub_genres[1]['name']);
        self::assertEquals(345, $item->sub_genres[1]['id']);
        self::assertContains('映像特典', $item->product_introduction);
        self::assertContains('日英美少女ゆるふわ学園コメディ、はじまるよ！', $item->story);
        self::assertContains('原悠衣', $item->staff_cast);
        self::assertCount(7, $item->sample_images);
        self::assertEquals('/brandnew/916600/c916600sample1.jpg', $item->sample_images[0]);
        self::assertEquals('/brandnew/916600/c916600sample7.jpg', $item->sample_images[6]);
        self::assertCount(17, $item->resources);
        self::assertEquals('http://www.getchu.com/brandnew/916600/c916600package.jpg', $item->resources[0]);
    }

    public function testCD()
    {
        $url = 'http://www.getchu.com/soft.phtml?id=945482';
        $gc = new GetchuSoft($url);
        $item = $gc->getItem();
        self::assertEquals('THE IDOLM＠STER CINDERELLA GIRLS STARLIGHT MASTER 09 ラブレター／島村卯月（CV：大橋彩香）、小日向美穂（CV：津田美波）、五十嵐響子（CV：種崎敦美）、安部菜々（CV：三宅麻理恵）、小早川紗枝（CV：立花理香）＜封入特典：ライブツアー先行抽選申し込みシリアルナンバー＞', $item->title);
        self::assertEquals('コロムビアミュージックエンタテインメント', $item->brand['name']);
        self::assertEquals(11163, $item->brand['id']);
        self::assertEquals('￥1,389 (税込￥1,500)', $item->price);
        self::assertEquals('2017/03/01', $item->release_date);
        self::assertEquals('AUDIO-CD', $item->media);
        self::assertEquals('4549767016573', $item->jan_code);
        self::assertEquals('COCC-17149', $item->part_number);
        self::assertEquals('大橋彩香、津田美波、種崎敦美、三宅麻理恵、立花理香', $item->artist);
        self::assertCount(2, $item->sub_genres);
        self::assertEquals('キャラクターソング', $item->sub_genres[0]['name']);
        self::assertEquals(357, $item->sub_genres[0]['id']);
        self::assertEquals('アーケード・アプリ・カードゲーム（CD）', $item->sub_genres[1]['name']);
        self::assertEquals(535, $item->sub_genres[1]['id']);
        self::assertContains('ラブレター', $item->product_introduction);
        self::assertContains('薄紅', $item->track_list);
        self::assertCount(1, $item->resources);
    }

    public function testGame()
    {
        $url = 'http://www.getchu.com/soft.phtml?id=11464&gc=gc';
        $gc = new GetchuSoft($url);
        $item = $gc->getItem();
        self::assertEquals('鬼哭街（きこくがい）', $item->title);
        self::assertEquals('ニトロプラス', $item->brand['name']);
        self::assertEquals(356, $item->brand['id']);
        self::assertEquals('￥4,400 (税込￥4,752)', $item->price);
        self::assertEquals('2002/03/29', $item->release_date);
        self::assertEquals('4529790024011', $item->jan_code);
        self::assertEquals('中央東口', $item->illustrator);
        self::assertEquals('虚淵玄', $item->scenario);
        self::assertEquals('アドベンチャー', $item->sub_genres[0]['name']);
        self::assertEquals(308, $item->sub_genres[0]['id']);
//        self::assertEquals('ノベル', $item->categories[0]);
//        self::assertEquals('近未来', $item->categories[1]);
//        self::assertEquals('バトル', $item->categories[2]);
//        self::assertEquals('ハードボイルド', $item->categories[3]);
        self::assertCount(10, $item->game_spec);
        self::assertEquals('対応OS：Win95/98/2000/Me/Xp', $item->game_spec[0]);

        self::assertContains('間違った未来、誰かが選択を誤った世界。', $item->synopsis);
        self::assertContains('舞台は近未来の上海。', $item->game_outline);
        self::assertContains('孔濤羅（コン・タオロー）', $item->character);
        self::assertCount(9, $item->sample_images);
    }
}