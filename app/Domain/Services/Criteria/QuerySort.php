<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:46 AM
 */

namespace App\Domain\Services\Criteria;


use App\Domain\Constants\Constant;
use App\Domain\Contracts\CriteriaInterface;

class QuerySort implements CriteriaInterface
{


    /**
     * sort by specific field
     * @var string
     */
    private $orderBy;
    /**
     * sorting direction asc or desc
     * @var string
     */
    private $sortedBy;


    /**
     * QuerySort constructor.
     * @param string $orderBy
     * @param string $sortedBy
     */
    public function __construct(string $orderBy, $sortedBy = Constant::DEFAULT_DIRECTION)
    {
        $this->orderBy = $orderBy;
        $this->sortedBy = $sortedBy;

    }

    /**
     * @param $model
     * @return mixed
     */
    public function apply($model)
    {
        return $model->orderBy($this->orderBy, $this->sortedBy);
    }

}