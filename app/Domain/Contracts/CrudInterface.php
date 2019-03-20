<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:32 AM
 */

namespace App\Domain\Contracts;


interface CrudInterface
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function getAll($attributes = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

}