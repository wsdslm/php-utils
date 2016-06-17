<?php
namespace ws\utils\pickers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LeopardRawsPicker
{
    public $path;
    public $rss_list;
    /**
     * @var \Monolog\Logger
     */
    public $log;

    public function __construct($conf)
    {
        $log_file = $conf['log_file'];
        $this->path = $conf['path'];
        $this->rss_list = $conf['rss'];

        $this->log = new Logger('picker');
        $handlerFile = new StreamHandler($log_file);
        $this->log->pushHandler($handlerFile);

        $handlerStdout = new StreamHandler(STDOUT);
        $this->log->pushHandler($handlerStdout);
    }

    public function pick()
    {
        foreach ($this->rss_list as $rss_url) {
            $rss = new LeopardRawsRss($rss_url);

            $download_path = $this->path . '/' . $rss->title;
            if (!file_exists($download_path)) {
                mkdir($download_path);
                $message = sprintf("[%s] mkdir %s\n", date('Y-m-d H:i:s'), $rss->title);
                $this->log->log(Logger::INFO, $message);
            }

            foreach ($rss->items as $item) {
                $file_item = $download_path . '/' . $item->title . '.torrent';
                if (!file_exists($file_item)) {
                    $data = file_get_contents($item->link);
                    file_put_contents($file_item, $data);
                    $message = sprintf("[%s] new torrent: %s.torrent\n", date('Y-m-d H:i:d'), $item->title);
                    $this->log->log(Logger::INFO, $message);
                }
            }
        }
    }
}
