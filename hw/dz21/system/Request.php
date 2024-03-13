<?php

class Request
{
    public static function getUrl(): string
    {
        $url = $_SERVER["REQUEST_URI"];

        if (str_contains($url, '?')) {
            $url = substr($url, 0, strpos($url, '?'));
        }

        return $url;
    }

    public static function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
}