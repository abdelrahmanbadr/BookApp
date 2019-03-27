<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/21/19
 * Time: 5:15 PM
 */

namespace Tests\Unit\Helpers;


use Tests\TestCase;
use App\Helpers\CommonHelper;

class CommonHelperTest extends TestCase
{
    

    public function columnLetterDataProvider()
    {
        return [
            [
                "number" => 1,
                "expected" => "A",
            ],
            [
                "number" => 2,
                "expected" => "B",
            ],
        ];
    }


    /**
     * @param int $number
     * @param string $expected
     * @dataProvider columnLetterDataProvider
     *
     * @return void
     */
    public function testColumnLetter(int $number, string $expected)
    {
        $this->assertEquals($expected, CommonHelper::columnLetter($number));
    }


}