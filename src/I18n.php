<?php

/*
 * Class able to use multiple languages
 */

namespace Datalaere\PHPMultilingual;

class I18n
{
    private static $locale;
    private static $texts;
    private static $storage;

    public static function set($locale)
    {
        self::$locale = $locale;
    }

    public static function register($path, $token)
    {
        self::$storage[$token] = $path;
    }

    public static function get($string, $return = true)
    {
        // we split up the string in path and key
        $path = strstr(strtolower($string), '_', true);
        $key  = substr($string, strpos($string, "_") + 1);

        // if not $key
        if (!$string) {
            return null;
        }

        // load config file (this is only done once per application lifecycle)
        self::$texts[$path] = require(self::$storage[$path] . '/' . substr(self::$locale, 0, -3) . '/' . substr(self::$locale, -2) . '.php');

        // check if array key exists
        if (!array_key_exists($string, self::$texts[$path])) {
            return null;
        }

        if ($return) {
            return self::$texts[$path][$string];
        } else {
            echo self::$texts[$path][$string];
        }
    }
}
