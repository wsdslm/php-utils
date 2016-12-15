<?php
namespace ws\utils\pickers;

use GuzzleHttp\Client;

class BaseSpider
{
    public $url;
    /**
     * @var Client
     */
    public $client;
    private $_doc;
    private $_xpath;

    public function __construct($url, $client = null)
    {
        $this->url = $url;
        $this->client = $client;
    }

    public function getClient()
    {
        if ($this->client)
            return $this->client;
        return new Client();
    }

    public function getContent()
    {
        return $this->getClient()->get($this->url)->getBody()->getContents();
    }

    public function getDOMDocument()
    {
        libxml_use_internal_errors(true);
        if (!$this->_doc) {
            $this->_doc = new \DOMDocument();
            $this->_doc->loadHTML($this->getContent());
        }
        return $this->_doc;
    }

    public function getXPath()
    {
        if (!$this->_xpath)
            $this->_xpath = new \DOMXPath($this->getDOMDocument());
        return $this->_xpath;
    }

    public function xQueryText($expression)
    {
        return $this->getXPath()->query($expression)->item(0)->textContent;
    }

    public function xQueryHtml($expression)
    {
        return $this->getDOMDocument()->saveHTML($this->getXPath()->query($expression)->item(0));
    }
}