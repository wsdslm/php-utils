<?php


namespace ws\utils\pickers;


class YandeReApi extends BaseSpider
{
    const BASE_URL = 'https://yande.re';

    public function __construct($tags = null, $page = null, $limit = null, $client = null)
    {
        $data = [
            'tags' => $tags,
            'page' => $page,
            'limit' => $limit,
        ];
        $url = self::BASE_URL . '/post.json?' . http_build_query($data);
        parent::__construct($url, $client);
    }

    /**
     * @return YandeReItem[]
     */
    public function getItems()
    {
        $items = [];
        $data = json_decode($this->getContent());
        foreach ($data as $image) {
            $items[] = $image;
        }
        return $items;
    }
}