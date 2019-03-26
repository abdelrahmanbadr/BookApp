<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:44 AM
 */

namespace App\Domain\Repositories;

use App\Domain\Contracts\RepositoryInterface;
use App\Domain\Services\Criteria\CriteriaBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseEloquentRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $entity;
    /**
     * Criteria list
     *
     * @var Collection
     */
    private $criteria;

    /**
     * BaseEloquentRepository constructor.
     * @param Model $entityModel
     */
    public function __construct(Model $entityModel)
    {
        $this->entity = $entityModel;
    }

    public function setCriteria(CriteriaBuilder $criteriaBuilder)
    {
        $criteriaBuilder->buildCriteria();
        $this->criteria = $criteriaBuilder->getCriteria();
    }

    /**
     * Return all entities, using the given criteria
     *
     * @param array $attributes
     * @return Collection
     */
    public function getAll(array $attributes = ['*']): Collection
    {
        $this->applyCriteria();

        return $this->entity->get($attributes);
    }

    /**
     * Get record by id.
     *
     * @param int $id
     * @return Model
     */
    public function get(int $id): Model
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * @param string $attributeName
     * @param mixed $value
     * @return mixed
     */
    public function findOneByAttribute(string $attributeName, $value)
    {
        return $this->entity->where($attributeName, '=', $value)->first();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->entity->create($attributes);
    }


    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        $row = $this->entity->find($id);
        $row->update($attributes);
        return $row;
    }



    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return $this->entity->destroy($id);
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if (!empty($this->criteria)) {
            foreach ($this->criteria as $criteria) {
                $this->entity = $criteria->apply($this->entity, $this);
            }
        }

        return $this;
    }

}