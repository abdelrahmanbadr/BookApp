<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:04 PM
 */

namespace App\Domain\Repositories;

use App\Domain\Contracts\BookRepositoryInterface;

class EloquentBookRepository extends BaseEloquentRepository implements BookRepositoryInterface
{
}