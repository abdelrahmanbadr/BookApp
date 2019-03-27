<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/21/19
 * Time: 5:15 PM
 */

namespace Tests\Unit\Helpers;


use Tests\TestCase;
use App\Helpers\UrlHelper;

class UrlHelperTest extends TestCase
{

    public function dataProvider()
    {
        return [
            [
                "path" => "/part1/part2",
                "expected" => "part2",
            ],
            [
                "path" => "/books/export",
                "expected" => "export",
            ],
        ];
    }


    /**
     * @param string $path
     * @param string $expected
     * @dataProvider dataProvider
     *
     * @return void
     */
    public function testGetLastPartOfPath(string $path, string $expected)
    {
        $this->assertEquals($expected, UrlHelper::getLastPartOfPath($path));
    }

}