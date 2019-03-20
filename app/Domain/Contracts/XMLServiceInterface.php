<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 2:57 PM
 */

namespace App\Domain\Contracts;


interface XMLServiceInterface
{
    /**
     * @param array $array
     * @return string
     */
    public function arrayToXML(array $array): string;

    /**
     * @param string $fileName
     * @param string $xml
     * @return string
     */
    public function saveXMLFile(string $fileName, string $xml): string;
}