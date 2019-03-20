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
     *  Uppercase the first character of each word in a string
     * @param string $attribute
     * @return string
     */
    public static function lowerStringAndUpperFirstChars(string $word)
    {
        return ucwords(strtolower($word));
    }


    public static function contains(string $word, string $needle)
    {
        return stripos($word, $needle) !== false;
    }

    public static function removeSpecialChars(string $word)
    {
        return preg_replace("/[^a-zA-Z]/", "", $word);
    }

}