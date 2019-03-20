<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:06 PM
 */

namespace App\Domain\Services;

use App\Domain\Contracts\{BookRepositoryInterface,
    BookServiceInterface,
    CollectionMapperInterface,
    ExcelServiceInterface,
    XMLServiceInterface};
use App\Domain\Exceptions\BadRequestException;


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
     */
    public function export(string $exportType, array $attributes): string
    {
        //@todo implement here
    }

    /**
     * @param CollectionMapperInterface $mapper
     */
    public function setMapper(CollectionMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }


}