<?php

namespace Examples;

use fize\super\SuperStdclass;

/**
 * @property string $name  姓名
 * @property int    $age   年龄
 */
class ReadOlySuperStd extends SuperStdclass
{

    /**
     * @var array 允许的属性名
     */
    protected $allowNames = ['name', 'age'];

    /**
     * @var bool 全部只读
     */
    protected $readOnlyAll = true;
}