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
}