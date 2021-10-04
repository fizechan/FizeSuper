<?php

namespace examples;

use PHPUnit\Framework\TestCase;

class TestReadOnlySuperStd extends TestCase
{

    public function testMy1()
    {
        $mySuperStd = new ReadOlySuperStd(
            [
                'name' => '陈峰展',
                'age' => 13
            ]
        );

        echo $mySuperStd->name;

        $mySuperStd->allowAppend('cfz');
        $mySuperStd->cfz = 'CFZ';

//        $mySuperStd->name = '不允许被修改';
        foreach ($mySuperStd as $key => $value) {
            echo "$key => \r\n";
            var_dump($value);
            echo "\r\n";
        }
    }
}
