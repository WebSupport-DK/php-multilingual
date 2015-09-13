<?php

/*
 * To change this license header, choose License Headers in Project Properties. 
 * To change this template file, choose Tools | Templates 
 * and open the template in the editor. 
 */

namespace thom855j\PHPMultilingual;

class I18n
{

    private static
            $locale, $texts, $storage;

    public static
            function set($locale)
    {

        self::$locale = $locale;
    }

    public static
            function register($path, $token)
    {

        self::$storage[$token] = $path;
    }

    public static
            function get($string, $return = true)
    {
        // we split up the string in path and key
        $path = strstr(strtolower($string), '_', true);
        $key  = substr($string, strpos($string, "_") + 1);

        // if not $key 
        if (!$string)
        {
            return null;
        }

        // load config file (this is only done once per application lifecycle) 
        self::$texts[$path] = require(self::$storage[$path] . '/' . substr(self::$locale, 0, -3) . '/' . substr(self::$locale, -2) . '.php');

        // check if array key exists 
        if (!array_key_exists($string, self::$texts[$path]))
        {
            return null;
        }

        if ($return)
        {
            return self::$texts[$path][$string];
        }
        else
        {
            echo self::$texts[$path][$string];
        }
    }

}
