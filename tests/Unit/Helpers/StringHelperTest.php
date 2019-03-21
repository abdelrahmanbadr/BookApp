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
    public function upperCaseFirstCharsDataProvider()
    {
        return [
            [
                "string" => "test UPPER case string",
                "expected" => "Test Upper Case String"
            ],
            [
                "string" => "martin fowler",
                "expected" => "Martin Fowler"
            ],
        ];
    }

    public function containsDataProvider()
    {
        return [
            [
                "string" => "testing",
                "needle" => "z",
                "expected" => false,
            ],
            [
                "string" => "input",
                "needle" => "t",
                "expected" => true
            ],
        ];
    }


    /**
     * @param string $string
     * @param string $expected
     * @dataProvider upperCaseFirstCharsDataProvider
     *
     * @return void
     */
    public function testUpperCaseFirstChars(string $string, string $expected)
    {
        $this->assertEquals($expected, StringHelper::lowerStringAndUpperFirstChars($string));
    }

    /**
     * @param string $string
     * @param string $needle
     * @param bool $expected
     * @dataProvider containsDataProvider
     *
     * @return void
     */
    public function testContains(string $string, string $needle, bool $expected)
    {
        $this->assertEquals($expected, StringHelper::contains($string, $needle));
    }

    public function removeSpecialCharsDataProvider()
    {
        return [
            [
                "string" => "user-name",
                "expected" => "username",
            ],
            [
                "string" => "first_name",
                "expected" => "firstname"
            ],
        ];
    }

    /**
     * @param string $string
     * @param string $expected
     * @dataProvider removeSpecialCharsDataProvider
     *
     * @return void
     */
    public function testRemoveSpecialChars(string $string, string $expected)
    {
        $this->assertEquals($expected, StringHelper::removeSpecialChars($string));
    }

}