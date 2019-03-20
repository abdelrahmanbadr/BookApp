<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:45 AM
 */

namespace App\Domain\Services\Criteria;

use App\Domain\Contracts\CriteriaInterface;

class QueryFilter implements CriteriaInterface
{
    /**
     * @var string field to where for
     */
    protected $field;

    /**
     * @var mixed value to check for
     */
    protected $value;


    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function apply($model)
    {
        return $model->where($this->field, "like", "%{$this->value}%");
    }

}