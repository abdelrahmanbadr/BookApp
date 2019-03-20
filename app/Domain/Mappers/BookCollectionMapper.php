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
    public function map(Collection $books): array
    {

        return $books->map(function ($book) {
            return $this->mapOne($book);
        })->toArray();
    }

    private function mapOne($book)
    {
        $mappedBook = new stdClass();
        $mappedBook->id = $book->id;
        $mappedBook->title = $this->mapTitle($book->title);
        $mappedBook->authorName = $this->mapAuthorName($book->authorName);
        return $mappedBook;
    }

    /**
     * @param string $name
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