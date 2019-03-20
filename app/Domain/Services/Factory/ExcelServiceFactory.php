<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 3:01 PM
 */

namespace App\Domain\Services\Factory;

use App\Domain\Services\ExcelService;
use App\Domain\Contracts\ExcelServiceInterface;

class ExcelServiceFactory
{
    /**
     * @return ExcelServiceInterface
     */
    public function make(): ExcelServiceInterface
    {
        return new ExcelService();
    }
}