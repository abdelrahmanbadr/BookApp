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
     * @param string $exportType
     * @param array $attributes
     * @return string
     */
    public function export(string $exportType, array $attributes): string;

}