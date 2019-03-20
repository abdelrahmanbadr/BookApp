<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 1:01 PM
 */

namespace Tests\Domain\Repositories;

use App\Domain\Entities\Book;
use App\Domain\Repositories\EloquentBookRepository;
use Tests\TestCase;
use Mockery;

class EloquentBookRepositoryTest extends TestCase
{
    private $bookMock;
    /**
     * @var EloquentBookRepository
     */
    private $repository;


    public function setup(): void
    {
        parent::setUp();
        $this->bookMock = Mockery::mock(Book::class);
        $this->repository = new EloquentBookRepository($this->bookMock);
    }

    /** @test * */
    function testGetBook()
    {
        $fakeBook = new Book();
        $fakeBook->id = 1;
        $fakeBook->title = "book title";

        $this->bookMock->shouldReceive('findOrFail')->with(1)->andReturn($fakeBook);
        $this->assertEquals($fakeBook, $this->repository->get(1));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

}