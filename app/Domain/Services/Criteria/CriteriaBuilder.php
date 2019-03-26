<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:45 AM
 */

namespace App\Domain\Services\Criteria;

use App\Domain\Constants\Constant;
use App\Helpers\StringHelper;
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
        $sort = $request->get(Constant::QUERY_PARAMETER_SORT);
        $search = $request->get(Constant::QUERY_PARAMETER_SEARCH);
        $searchFields = $request->get(Constant::QUERY_PARAMETER_SEARCH_FIELDS);

        if (!empty($sort)) {
            $this->pushSortCriteria($sort);
        }

        if (!empty($filters)) {
            $this->pushFilterCriteria($filters);
        }

        if (!empty($search) && (!empty($searchFields))) {
            $this->pushSearchCriteria($search, $searchFields);
        }
    }

    private function pushSearchCriteria(string $search, string $searchFields)
    {
        $fields = explode(",", $searchFields);
        $this->PushCriteria(new QuerySearch($fields, $search));
    }

    private function pushFilterCriteria(string $filters)
    {
        $filters = explode(",", $filters);
        foreach ($filters as $filter) {
            $query = explode(':', $filter);
            $this->PushCriteria(new QueryFilter($query[0], $query[1]));
        }

    }

    private function pushSortCriteria(string $sort)
    {
        $orderBy = StringHelper::removeSpecialChars($sort);
        if (StringHelper::contains($sort, "-")) {
            $this->PushCriteria(new QuerySort($orderBy, Constant::DESC_DIRECTION));
        }
        $this->PushCriteria(new QuerySort($orderBy));
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