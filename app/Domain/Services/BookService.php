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

    private function exportToExcel(array $attributes)
    {

        $sheet = $this->excelService->getActiveSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_TITLE_BOOKS_TITLE_AND_AUTHOR);
        $sheet->setCellValue('A' . 1, "Title");
        $sheet->setCellValue('B' . 1, "Author Name");
        $counter = 1;
        //@todo refactor this part
        foreach ($this->getAll() as $book) {
            $counter++;
            if (!empty($attributes)) {
                foreach ($attributes as $key => $attribute) {

                    if (isset($book->$attribute)) {
                        $key++;
                        $sheet->setCellValue(CommonHelper::columnLetter($key) . $counter, $book->$attribute);
                    }
                }
            } else {
                $sheet->setCellValue('A' . $counter, $book->title);
                $sheet->setCellValue('B' . $counter, $book->authorName);
            }

        }

        return $this->excelService->saveExcelSheet(Constant::FILE_PATH_BOOKS_TITLE_AND_AUTHOR);
    }

    private function exportToXML(array $attributes)
    {

    }

    /**
     * @param CollectionMapperInterface $mapper
     */
    public function setMapper(CollectionMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }


}