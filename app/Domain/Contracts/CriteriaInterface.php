<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 11:32 AM
 */

namespace App\Domain\Contracts;


interface CriteriaInterface
{
    /**
     * @param $model
     * @return mixed
     */
    public function apply($model);

}