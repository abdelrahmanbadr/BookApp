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
    public static function lowerStringAndUpperFirstChars(string $attribute)
    {
        return ucwords(strtolower($attribute));
    }

}