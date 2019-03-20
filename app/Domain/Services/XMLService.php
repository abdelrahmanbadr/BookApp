<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 2:48 PM
 */

namespace App\Domain\Services;


use App\Domain\Contracts\XMLServiceInterface;
use Spatie\ArrayToXml\ArrayToXml;

class XMLService implements XMLServiceInterface
{
    /**
     * @param array $array
     * @return string
     */
    public function arrayToXML(array $array): string
    {
        return ArrayToXml::convert($array);
    }

    /**
     * @param string $fileName
     * @param string $xml
     * @return string
     */
    public function saveXMLFile(string $fileName, string $xml): string
    {
        $fileName = $fileName . ".xml";
        file_put_contents($fileName, $xml);
        return $fileName;
    }


}