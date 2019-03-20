<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 3:11 PM
 */

namespace App\Helpers;


class UrlHelper
{
    /**
     * @param string $path
     * @return mixed
     */
    public static function getLastPartOfPath(string $path)
    {
        $uriParts = explode('/', $path);
        return end($uriParts);
    }

}