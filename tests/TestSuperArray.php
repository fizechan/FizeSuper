<?php

namespace Tests;

use Fize\Super\SuperArray;
use PHPUnit\Framework\TestCase;

class TestSuperArray extends TestCase
{

    public function testChangeKeyCase()
    {
        $array = [
            'key1' => '哈哈哈，不错哦',
            'KeY2' => '中都是什么鬼！'
        ];
        $spa = new SuperArray($array);
        $array1 = $spa->changeKeyCase();
        var_dump($array1);
        self::assertNotEquals($array, $array1);
        $array2 = $spa->changeKeyCase(1);
        var_dump($array2);
        self::assertNotEquals($array2, $array1);
    }

    public function testToLevel1()
    {
        $array = [
            'A1' => '这是层级1',
            'A2' => [
                'B1' => '这是层级2',
                'B2' => ['我是个无key数组1！', '我是个无key数组2！'],
                'B3' => [
                    'C1' => '厉害了3！',
                    'C2' => '我还能说啥？',
                    'C3' => [
                        'D1' => '单个字段问题也解决了！'
                    ]
                ]
            ]
        ];
        $spa = new SuperArray($array);
        $alv1 = $spa->toLevel1('_', true, false);
        var_dump($alv1);
        self::assertNotEquals($alv1, $array);
        $alv2 = $spa->toLevel1('_', false, false);
        var_dump($alv2);
        self::assertNotEquals($alv1, $alv2);
        $alv3 = $spa->toLevel1();
        self::assertEquals($alv1, $alv3);
    }
}
