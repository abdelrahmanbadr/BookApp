<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 1:19 PM
 */

namespace App\Domain\Services\Factory;

use App\Domain\Contracts\BookServiceInterface;
use App\Domain\Entities\Book;
use App\Domain\Mappers\BookCollectionMapper;
use App\Domain\Repositories\EloquentBookRepository;
use App\Domain\Services\{Criteria\CriteriaBuilder, BookService};


class BookServiceFactory
{
    /**
     * @return BookServiceInterface
     */
    public function make(): BookServiceInterface
    {
        $bookMapper = new BookCollectionMapper();
        $bookRepository = new EloquentBookRepository(new Book());
        $bookRepository->setCriteria(new CriteriaBuilder());
        $excelService = (new ExcelServiceFactory())->make();
        $xmlService = (new XMLServiceFactory())->make();
        return new BookService($bookRepository, $bookMapper, $excelService, $xmlService);
    }
}