<?php
namespace ws\utils\helpers;

class CommonHelper
{
    public static function getParamValue($url, $name)
    {
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $params);
        if (isset($params[$name]))
            return $params[$name];
        return '';
    }

    public static function handlePath($path)
    {
        $path = trim(str_replace(['/', '\\', '*', '>', '<', '|', '?', '"',], ' ', $path));
        if (stripos(PHP_OS, 'win') !== false) {
            $path = iconv('UTF-8', 'GBK//IGNORE', $path);
        }
        return $path;
    }
}