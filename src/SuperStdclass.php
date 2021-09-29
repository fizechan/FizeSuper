<?php

namespace fize\super;

use stdClass;

/**
 * 超级基类
 *
 * 使用该类可以定义可变属性、只读属性、只写属性。
 */
class SuperStdclass extends stdClass
{

    protected $data = [];

    protected $allowKeys;

    public function __construct(array $data = [], array $allowKeys = null)
    {
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * 设置运行的属性名
     * @param array $keys 属性名数组
     */
    public function allow(array $keys)
    {
        $this->allowKeys = $keys;
    }

    public function allowAppend($key)
    {

    }

    public function allowDelete($key)
    {

    }

    public function readonly(array $keys)
    {

    }

    public function readonlyAll(bool $readonly = true)
    {

    }

    protected function assertKey($key)
    {

    }
}
