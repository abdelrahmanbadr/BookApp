<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:30 AM
 */

namespace App\Domain\Contracts;


interface RepositoryInterface
{
    /**
     * Creates a new entity
     *
     * @param array $attributes Data the entity will have.
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Get's a entity by it's id
     *
     * @param int
     * @return mixed
     */
    public function get(int $id);

    /**
     * @param string $attributeName
     * @param mixed $value
     * @return mixed
     */
    public function findOneByAttribute(string $attributeName, $value);

    /**
     * Get's all entities.
     *
     * @param array $attributes
     * @return mixed
     */
    public function getAll(array $attributes);

    /**
     * Deletes a entity.
     *
     * @param int
     */
    public function delete(int $id);

    /**
     * Updates a entity.
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

   
}