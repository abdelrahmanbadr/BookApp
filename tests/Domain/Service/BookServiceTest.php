<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 1:04 PM
 */

namespace Tests\Domain\Service;

use App\Domain\Entities\Book;
use App\Domain\Mappers\BookCollectionMapper;
use App\Domain\Repositories\EloquentBookRepository;
use App\Domain\Services\BookService;
use Mockery;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    /**
     * @var EloquentBookRepository
     */
    private $bookRepositoryMock;

    /**
     * @var BookService
     */
    private $service;


    public function setup(): void
    {
        parent::setUp();
        $this->bookRepositoryMock = Mockery::mock(EloquentBookRepository::class);
        $this->service = new BookService($this->bookRepositoryMock, new BookCollectionMapper());

    }

    /**
     * test create book in book service
     */
    public function testCreateBook()
    {
        $fakeBook = new Book();
        $fakeBook->title = "head first";
        $fakeBook->authorName = "Kathy Sierra";
        $this->bookRepositoryMock->shouldReceive("create")->with($fakeBook->toArray())->andReturn($fakeBook);
        $actualCreatedBook = $this->service->create($fakeBook->toArray());
        $this->assertEquals($fakeBook->title, $actualCreatedBook->title);
    }
}