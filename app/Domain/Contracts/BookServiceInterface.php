<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:34 AM
 */

namespace App\Domain\Contracts;


interface BookServiceInterface extends CrudInterface
{
    /**
     * @return mixed
     */
    public function getAllWithAuthorName();

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createBookAndAuthorIfNotExist(array $attributes);

    /**
     * @param string $exportType
     * @param array $attributes
     * @return string
     */
    public function export(string $exportType, array $attributes): string;
    
}