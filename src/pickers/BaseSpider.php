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
    private $_content;

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
        if (!$this->_content) {
            $this->_content = $this->getClient()->get($this->url)->getBody()->getContents();
        }
        return $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = $content;
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

    /**
     * @param string $expression
     * @return \DOMElement|null
     */
    public function getNode($expression)
    {
        $nodeList = $this->getXPath()->query($expression);
        if ($nodeList->length > 0)
            return $nodeList->item(0);
        return null;
    }

    /**
     * @param \DOMElement $node
     */
    public function getHtml($node = null)
    {
        $this->getDOMDocument()->saveHTML($node);
    }

    public function getNodeHtml($node)
    {
        if (!$node)
            return '';
        return $this->getDOMDocument()->saveHTML($node);
    }

    public function xQueryText($expression, $node = null)
    {
        $nodeList = $this->getXPath()->query($expression, $node);
        if ($nodeList->length > 0)
            return $nodeList->item(0)->textContent;
        return '';
    }

    /**
     * @param string $expression
     * @return string
     */
    public function xQueryHtml($expression)
    {
        $nodeList = $this->getXPath()->query($expression);
        if ($nodeList->length > 0)
            return $this->getDOMDocument()->saveHTML($nodeList->item(0));
        return '';
    }

    /**
     * @param string $url
     * @return string
     */
    public function getAbsUrl($url)
    {
        if ($url[0] == '.') {
            $base_url = dirname($this->url);
            $url = substr_replace($url, $base_url, 0, 1);
        }
        if ($url[0] == '/') {
            $base_url = parse_url($this->url, PHP_URL_HOST);
            $url = $base_url . $url;
        }
        if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0)
            $url = 'http://' . $url;
        return $url;
    }

    public function getPath($url)
    {
        $url = $this->getAbsUrl($url);
        if (parse_url($this->url, PHP_URL_HOST) != parse_url($url, PHP_URL_HOST))
            return $url;
        return parse_url($url, PHP_URL_PATH);
    }

    /**
     * @param \DOMElement $node
     * @return array
     */
    public function getImageLink($node)
    {
        $links = [];
        foreach ($this->getXPath()->query('a[img]', $node) as $n) {
            /* @var \DOMElement $n */
            $links[] = $this->getAbsUrl($n->getAttribute('href'));
        }
        return $links;
    }
}