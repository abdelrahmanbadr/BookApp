<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 2:48 PM
 */

namespace App\Domain\Services;

use App\Domain\Contracts\ExcelServiceInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelService implements ExcelServiceInterface
{
    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * ExcelService constructor.
     */
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }

    /**
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function getActiveSheet()
    {
        return $this->spreadsheet->getActiveSheet();
    }

    /**
     * @param string $fileName
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function saveExcelSheet(string $fileName): string
    {
        $fileName = $fileName . ".xlsx";
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($fileName);
        return $fileName;
    }

}