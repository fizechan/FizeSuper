<?php

namespace Examples;

use PHPUnit\Framework\TestCase;

class TestMySuperStd extends TestCase
{

    public function testMy1()
    {
        $mySuperStd = new MySuperStd(
            [
                'data' => ['test' => '测试一下'],
                'notAllowName' => '这个属性不被允许'
            ]
        );

        $mySuperStd->allow(null);
        $mySuperStd->notAllowName = '这个属性现在被允许';

        $mySuperStd->name = '陈峰展';
        $mySuperStd->age = 31;
        foreach ($mySuperStd as $key => $value) {
            echo "$key => \r\n";
            var_dump($value);
            echo "\r\n";
        }
    }

    public function testMy2()
    {
        $mySuperStd = new MySuperStd(
            [
                'data' => ['test' => '测试一下']
            ]
        );

        $mySuperStd->allow(['name', 'age', 'data', 'notAllowName']);
        $mySuperStd->notAllowName = '这个属性现在被允许';

        $mySuperStd->allowAppend('notAllowName2');
        $mySuperStd->notAllowName2 = '属性【notAllowName2】现在被允许';

        $mySuperStd->allowAll();
        $mySuperStd->notAllowName3 = '属性【notAllowName3】现在被允许';

        $mySuperStd->allowDelete('notAllowName2');
        $mySuperStd->notAllowName2 = '属性【notAllowName2】现在不被允许';

        $mySuperStd->name = '陈峰展';
        $mySuperStd->age = 31;
        foreach ($mySuperStd as $key => $value) {
            echo "$key => \r\n";
            var_dump($value);
            echo "\r\n";
        }
    }
}
