<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 2:56 PM
 */

namespace App\Domain\Contracts;


interface ExcelServiceInterface
{

    public function getActiveSheet();

    public function saveExcelSheet(string $fileName): string;
}