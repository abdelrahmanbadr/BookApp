<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/21/19
 * Time: 11:52 AM
 */

namespace App\Helpers;


class CommonHelper
{


    public static function columnLetter(int $number)
    {

        if ($number <= 0) {
            return '';
        }

        $letter = '';

        while ($number != 0) {
            $p = ($number - 1) % 26;
            $number = intval(($number - $p) / 26);
            $letter = chr(65 + $p) . $letter;
        }

        return $letter;

    }


}