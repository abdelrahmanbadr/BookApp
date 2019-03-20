<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:35 PM
 */

namespace App\Helpers;


class StringHelper
{
    /**
     * @param string $word
     * @return string
     */
    public static function lowerStringAndUpperFirstChars(string $word)
    {
        return ucwords(strtolower($word));
    }


    /**
     * @param string $string
     * @param string $needle
     * @return bool
     */
    public static function contains(string $string, string $needle)
    {
        return stripos($string, $needle) !== false;
    }

    /**
     * @param string $string
     * @return null|string|string[]
     */
    public static function removeSpecialChars(string $string)
    {
        return preg_replace("/[^a-zA-Z]/", "", $string);
    }

    /**
     * @param string $string
     * @return array
     */
    public static function commaExplode(string $string)
    {
        return explode(',', $string);
    }

}