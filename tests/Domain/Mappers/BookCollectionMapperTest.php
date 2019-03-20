<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:56 PM
 */

namespace Tests\Domain\Mappers;


use App\Domain\Mappers\BookCollectionMapper;
use Illuminate\Support\Collection;
use Tests\TestCase;

class BookCollectionMapperTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                "books" => collect([
                    (object)[
                        "id" => 1,
                        "title" => "Refactoring: Improving the Design of Existing Code",
                        "authorName" => "martin fowler",
                    ],
                    (object)[
                        "id" => 2,
                        "title" => "Testing Computer Software",
                        "authorName" => "cem kaner",
                    ]
                ]),
                "expectedMappedBooks" => [
                    (object)[
                        "id" => 1,
                        "title" => "Refactoring: Improving The Design Of Existing Code",
                        "authorName" => "Martin Fowler"
                    ],
                    (object)[
                        "id" => 2,
                        "title" => "Testing Computer Software",
                        "authorName" => "Cem Kaner",
                    ],

                ],

            ],
        ];

    }


    /**
     * testing map  book collection
     *
     * @param Collection $books
     * @param array $expectedMappedBooks
     *
     * @dataProvider dataProvider
     * @return void
     */
    public function testBookMapper(Collection $books, array $expectedMappedBooks)
    {
        $mapper = new BookCollectionMapper();

        $actualMappedBook = $mapper->map($books);
        $this->assertEquals($actualMappedBook, $expectedMappedBooks);
    }


}