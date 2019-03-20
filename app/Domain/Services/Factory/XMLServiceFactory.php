<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 3:01 PM
 */

namespace App\Domain\Services\Factory;


use App\Domain\Contracts\XMLServiceInterface;
use App\Domain\Services\XMLService;

class XMLServiceFactory
{
    /**
     * @return XMLServiceInterface
     */
    public function make(): XMLServiceInterface
    {
        return new XMLService();
    }
}