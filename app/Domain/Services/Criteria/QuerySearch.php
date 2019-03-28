<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/26/19
 * Time: 3:04 PM
 */

namespace App\Domain\Services\Criteria;

use App\Domain\Contracts\CriteriaInterface;

class QuerySearch implements CriteriaInterface
{
    /**
     * @var array fields to where for
     */
    protected $fields;

    /**
     * @var mixed value to check for
     */
    protected $value;


    public function __construct(array $fields, $value)
    {
        $this->fields = $fields;
        $this->value = $value;
    }


    public function apply($model)
    {
        foreach ($this->fields as $key => $field) {
            if ($key == 0) {
                $model = $model->where($field, "like", "%{$this->value}%");
                continue;
            }
            $model = $model->orWhere($field, "like", "%{$this->value}%");
        }

        return $model;
    }
}