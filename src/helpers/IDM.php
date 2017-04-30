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
            $cmd .= sprintf(' /f "%s"', $filename);
        if ($save_path)
            $cmd .= sprintf(' /p "%s"', $save_path);
        exec($cmd);
    }
}
