<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:14 PM
 */

namespace App\Domain\Mappers;


use App\Helpers\StringHelper;
use App\Domain\Contracts\CollectionMapperInterface;
use Illuminate\Support\Collection;
use stdClass;

class BookCollectionMapper implements CollectionMapperInterface
{
    /**
     * @param Collection $books
     * @return array
     */
    public function map(Collection $books): array
    {
        return $books->map(function ($book) {
            return $this->mapOne($book);
        })->toArray();
    }

    /**
     * @param array $books
     * @param array $attributes
     * @return array
     */
    public function mapKeys(array $books, array $attributes = []): array
    {
        if (empty($books)) {
            return [];
        }
        $mappedBooks = [];
        foreach ($books as $key => $book) {
            $key++;
            if (empty($attributes)) {
                $mappedBooks["Author " . $key] = ["title" => $book->title, "authorName" => $book->authorName];
            } else {
                foreach ($attributes as $attribute) {
                    $mappedBooks["Author " . $key] = [$attribute => $book->$attribute, $attribute => $book->$attribute];
                }
            }
        }
        return $mappedBooks;
    }

    /**
     * @param $book
     * @return stdClass
     */
    private function mapOne($book)
    {
        $mappedBook = new stdClass();
        $mappedBook->id = $book->id;
        if (isset($book->title)) {
            $mappedBook->title = $this->mapTitle($book->title);
        }
        if (isset($book->authorName)) {
            $mappedBook->authorName = $this->mapAuthorName($book->authorName);
        }
        return $mappedBook;
    }

    /**
     * @param string $title
     * @return string
     */
    private function mapTitle(string $title)
    {
        return StringHelper::lowerStringAndUpperFirstChars($title);
    }

    /**
     * @param string $name
     * @return string
     */
    private function mapAuthorName(string $name)
    {
        return StringHelper::lowerStringAndUpperFirstChars($name);
    }
}