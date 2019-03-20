<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 1:50 PM
 */

namespace App\Domain\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    protected $message = 'Bad Request';
}