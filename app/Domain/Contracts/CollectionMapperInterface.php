<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:37 AM
 */

namespace App\Domain\Contracts;

use Illuminate\Support\Collection;

interface CollectionMapperInterface
{
    /**
     * @param Collection $collection
     * @return array
     */
    public function map(Collection $collection): array;

    /**
     * @param array $books
     * @param array $attributes
     * @return array
     */
    public function mapKeys(array $books, array $attributes): array;

}