<?php
namespace ws\utils\helpers;

/**
 * 需要IDM为启动状态
 * https://www.internetdownloadmanager.com/
 */
class IDM
{
    public static $bin_path = 'C:\Program Files (x86)\Internet Download Manager\IDMan.exe';

    public static function add_file($url, $filename = '', $save_path = '')
    {
        $cmd = sprintf('"%s" /a /d %s', self::$bin_path, $url);
        if ($filename)
            if ($save_path)
                $cmd = sprintf('"%s" /a /p "%s" /f "%s" /d %s', self::$bin_path, $save_path, $filename, $url);
            else
                $cmd = sprintf('"%s" /a /f "%s" /d %s', self::$bin_path, $filename, $url);
        exec($cmd);
    }
}
