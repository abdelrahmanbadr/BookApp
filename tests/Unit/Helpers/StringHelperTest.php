<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 12:45 PM
 */

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use App\Helpers\StringHelper;

class StringHelpersTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                "input" => "test UPPER case string",
                "expected" => "Test Upper Case String"
            ],
            [
                "input" => "martin fowler",
                "expected" => "Martin Fowler"
            ],
        ];
    }

    /**
     * @param string $input
     * @param string $expected
     * @dataProvider dataProvider
     *
     * @return void
     */
    public function testUpperCaseFirstChars(string $input, string $expected)
    {
        $this->assertEquals($expected, StringHelper::lowerStringAndUpperFirstChars($input));
    }

}