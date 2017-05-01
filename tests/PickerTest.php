<?php
use ws\utils\pickers\Amiami;
use ws\utils\pickers\LeopardRawsRss;
use ws\utils\pickers\Moeyo;
use ws\utils\pickers\ToyNavi;
use ws\utils\pickers\YandeReApi;

class LeopardRawsTest extends PHPUnit_Framework_TestCase
{
    public function testLeopardRaws()
    {
        $url = 'http://leopard-raws.org/rss.php?search=Bishoujo+Yuugi+Unit+Crane+Game';
        $rss = new LeopardRawsRss($url);
        $this->assertEquals('Leopard-Raws - Bishoujo Yuugi Unit Crane Game', $rss->title);
        $this->assertGreaterThan(1, count($rss->items));
    }

    public function testAmiami()
    {
        $url = 'http://www.amiami.jp/top/detail/detail?scode=FIGURE-027356';
        $amiami = new Amiami($url);
        $item = $amiami->getItem();
        self::assertEquals('【限定販売】アルファオメガ アイドルマスター シンデレラガールズ 渋谷凛 Triad Primus Ver.[アルファオメガ（アルター×メガハウス）]', $item->title);
        self::assertCount(27, $item->resources);
        self::assertEquals('http://img.amiami.jp/images/product/review/171/FIGURE-027356_01.jpg', $item->resources[0]);
    }

    public function testToyNavi()
    {
        $url = 'http://toy-navi.net/archives/49456466.html';
        $tn = new ToyNavi($url);
        $item = $tn->getItem();
        self::assertEquals('Fate/Grand Order『セイバー/アルトリア・ペンドラゴン[オルタ] ドレスVer.』をキャストオフしてみた', $item->title);
        self::assertCount(25, $item->resources);
        self::assertEquals('http://livedoor.blogimg.jp/figurenews/imgs/1/c/1c503823.jpg', $item->resources[0]);
    }

    public function testMoeyo()
    {
        $url = 'http://www.moeyo.com/article/85048';
        $moeyo = new Moeyo($url);
        $item = $moeyo->getItem();
        self::assertEquals('グッドスマイルカンパニー新作フィギュア「劇場版 魔法少女まどか☆マギカ 美樹さやか ～始まりの物語/永遠の物語～」予約開始！【WF2017冬】', $item->title);
        self::assertCount(8, $item->resources);
        self::assertEquals('http://cdn.moeyo.com/2017/0302/01/001.jpg', $item->resources[0]);
    }

    public function testYandeRe()
    {
        $tags = 'dakimakura';
        $client = new \GuzzleHttp\Client(['defaults' => [
            'verify' => false
        ]]);
        $yr = new YandeReApi($tags, null, null,$client);
        $items = $yr->getItems();
        self::assertNotEmpty($items);
    }
}
