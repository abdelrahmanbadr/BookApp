<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:45 AM
 */

namespace App\Domain\Services\Criteria;

use App\Domain\Constants\Constant;
use Illuminate\Support\Collection;
use App\Domain\Contracts\CriteriaInterface;

class CriteriaBuilder
{
    /**
     * Criteria list
     *
     * @var Collection
     */
    private $criteriaCollection;

    /**
     * CriteriaBuilder constructor
     *
     */
    public function __construct()
    {
        $this->criteriaCollection = collect();
    }


    public function buildCriteria()
    {
        $request = request();
        $filters = $request->get(Constant::QUERY_PARAMETER_FILTER);
        $orderBy = $request->get(Constant::QUERY_PARAMETER_SORT_BY);
        $sortedBy = $request->get(Constant::QUERY_PARAMETER_ORDER_BY);

        if (!empty($orderBy)) {
            $this->pushSortCriteria($orderBy, $sortedBy);
        }

        if (!empty($filters)) {
            $this->pushFilterCriteria($filters);
        }
    }

    private function pushFilterCriteria($filters)
    {
        $filters = explode(",", $filters);

        foreach ($filters as $filter) {
            $query = explode(':', $filter);
            $this->PushCriteria(new QueryFilter($query[0], $query[1]));
        }

    }

    private function pushSortCriteria($orderBy, $sortedBy = Constant::DEFAULT_DIRECTION)
    {
        $this->PushCriteria(new QuerySort($orderBy, $sortedBy));
    }


    /**
     * Get Criteria Collection
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCriteria()
    {
        return $this->criteriaCollection;
    }


    /**
     * push Criteria for $criteria collection
     * @param $criteria
     *
     * @return $this
     */
    public function PushCriteria(CriteriaInterface $criteria)
    {
        $this->criteriaCollection->push($criteria);
        return $this;
    }
}