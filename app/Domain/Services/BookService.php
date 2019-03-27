<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:06 PM
 */

namespace App\Domain\Services;

use App\Domain\Constants\Constant;
use App\Domain\Contracts\{BookRepositoryInterface,
    BookServiceInterface,
    CollectionMapperInterface,
    ExcelServiceInterface,
    XMLServiceInterface};
use App\Domain\Exceptions\BadRequestException;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Log;


class BookService implements BookServiceInterface
{

    /**
     * @var CollectionMapperInterface
     */
    private $mapper;
    /**
     * @var BookRepositoryInterface
     */
    private $repository;
    /**
     * @var ExcelServiceInterface
     */
    private $excelService;
    /**
     * @var XMLServiceInterface
     */
    private $xmlService;


    /**
     * BookService constructor.
     * @param BookRepositoryInterface $repository
     * @param CollectionMapperInterface $mapper
     * @param ExcelServiceInterface $excelService
     * @param XMLServiceInterface $xmlService
     */
    public function __construct(BookRepositoryInterface $repository, CollectionMapperInterface $mapper, ExcelServiceInterface $excelService, XMLServiceInterface $xmlService)
    {
        $this->repository = $repository;
        $this->mapper = $mapper;
        $this->excelService = $excelService;
        $this->xmlService = $xmlService;

    }

    /**
     * @param array $attributes
     * @return array|mixed
     * @throws BadRequestException
     */
    public function getAll($attributes = ['*'])
    {
        try {
            $books = $this->repository->getAll($attributes);
        } catch (\Exception $e) {
            Log::error("Error while getting all books, with error " . $e->getMessage());
            throw new BadRequestException();
        }
        return $this->mapper->map($books);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        return $this->repository->get($id);

    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {

        return $this->repository->update($id, $attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param string $exportType
     * @param array $attributes
     * @return string
     * @throws BadRequestException
     */
    public function export(string $exportType, array $attributes): string
    {
        if ($exportType == Constant::EXCEL_EXPORT) {
            return $this->exportToExcel($attributes);
        } elseif ($exportType == Constant::XML_EXPORT) {
            return $this->exportToXML($attributes);
        }
        Log::error("not valid export type");
        throw new BadRequestException();

    }

    /**
     * @param array $fields
     * @return string
     * @throws BadRequestException
     */
    private function exportToExcel(array $fields)
    {
        $sheet = $this->excelService->getActiveSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_BOOKS_TITLE);

        if (empty($fields)) {
            $this->setCellsWithAllFields($sheet);
        } else {
            $this->setCellsWithSpecificFields($sheet, $fields);
        }

        return $this->excelService->saveExcelSheet(Constant::FILE_PATH_EXCEL_BOOKS);
    }

    /**
     * @param $sheet
     * @param $fields
     * @throws BadRequestException
     */
    private function setCellsWithSpecificFields(&$sheet, $fields)
    {
        foreach ($this->getAll($fields) as $key => $book) {
            $key++;
            foreach ($fields as $fieldKey => $field) {
                if (isset($book->$field)) {
                    $fieldKey++;
                    $sheet->setCellValue(CommonHelper::columnLetter($fieldKey) . $key, $book->$field);
                }
            }
        }

    }

    /**
     * @param $sheet
     * @throws BadRequestException
     */
    private function setCellsWithAllFields(&$sheet)
    {
        foreach ($this->getAll() as $key => $book) {
            $key++;
            $sheet->setCellValue('A' . $key, $book->title);
            $sheet->setCellValue('B' . $key, $book->authorName);
        }
    }

    private function exportToXML(array $fields)
    {
        if (empty($fields)) {
            $books = $this->getAll();
        } else {
            $books = $this->getAll($fields);
        }
        $xml = $this->xmlService->arrayToXML($this->mapper->mapKeys($books, $fields));
        return $this->xmlService->saveXMLFile(Constant::FILE_PATH_XML_BOOKS, $xml);
    }


}