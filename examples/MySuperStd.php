<?php

namespace Examples;

use fize\super\SuperStdclass;

/**
 * @property string $name  姓名
 * @property int    $age   年龄
 * @property array  $data  数据
 */
class MySuperStd extends SuperStdclass
{

    /**
     * @var array 允许的属性名
     */
    protected $allowNames = ['name', 'age', 'data'];
}