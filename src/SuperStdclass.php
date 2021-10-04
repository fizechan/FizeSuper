<?php

namespace fize\super;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use OutOfBoundsException;
use stdClass;


/**
 * 超级基类
 *
 * 使用该类可以定义可变属性、只读属性、只写属性。
 */
class SuperStdclass extends stdClass implements ArrayAccess, IteratorAggregate
{

    /**
     * @var array 数据
     */
    protected $data = [];

    /**
     * @var array 允许的属性名(白名单)
     */
    protected $allowNames = null;

    /**
     * @var array 不允许的属性名(黑名单)
     */
    protected $notAllowNames = [];

    /**
     * @var array 只读属性名
     */
    protected $readOnlyNames = null;

    /**
     * @var bool 全部只读
     */
    protected $readOnlyAll = false;

    /**
     * @var array 只写属性名
     */
    protected $writeOnlyNames = null;

    /**
     * @var bool 全部只写
     */
    protected $writeOnlyAll = false;

    /**
     * 初始化
     * @param array $data 属性数据
     */
    public function __construct(array $data = [])
    {
        if (!is_null($this->allowNames)) {
            foreach ($data as $name => $value) {
                $this->assertAllow($name);
            }
        }
        $this->data = $data;
    }

    /**
     * 设置属性
     * @param string $name  属性名
     * @param mixed  $value 属性值
     */
    public function __set(string $name, $value)
    {
        $this->assertAllow($name);
        $this->assertNotReadOnly($name);
        $this->data[$name] = $value;
    }

    /**
     * 获取属性
     * @param string $name 属性名
     * @return mixed
     */
    public function __get(string $name)
    {
        $this->assertAllow($name);
        $this->assertNotWriteOnly($name);

        if (!isset($this->data[$name])) {
            throw new OutOfBoundsException("不存在的属性：$name");
        }
        return $this->data[$name];
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * 聚合式迭代器
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

    /**
     * 设置允许的属性名
     * @param array $names 属性名数组
     */
    public function allow(array $names)
    {
        $this->allowNames = $names;
    }

    /**
     * 允许所有属性名
     */
    public function allowAll()
    {
        $this->allowNames = null;
    }

    /**
     * 新增允许的属性名
     * @param string $name 属性名
     */
    public function allowAppend(string $name)
    {
        if (is_null($this->allowNames)) {
            $this->allowNames = [];
        }
        if (!in_array($name, $this->allowNames)) {
            $this->allowNames[] = $name;
        }
    }

    /**
     * 删除允许的属性名
     * @param string $name 属性名
     */
    public function allowDelete(string $name)
    {
        if (is_null($this->allowNames)) {
            $this->notAllowAppend($name);
        } else {
            $index = array_search($name, $this->allowNames);
            if ($index !== false) {
                array_splice($this->allowNames, $index);
            }
        }
    }

    /**
     * 设置不允许的属性名
     * @param array $names 属性名数组
     */
    public function notAllow(array $names)
    {
        $this->notAllowNames = $names;
    }

    /**
     * 清空不允许的属性名
     */
    public function notAllowEmpty()
    {
        $this->notAllowNames = [];
    }

    /**
     * 删除不允许的属性名
     * @param string $name 属性名
     */
    public function notAllowDelete(string $name)
    {
        $index = array_search($name, $this->notAllowNames);
        if ($index !== false) {
            array_splice($this->notAllowNames, $index);
        }
    }

    /**
     * 新增不允许的属性名
     * @param string $name 属性名
     */
    public function notAllowAppend(string $name)
    {
        if (!in_array($name, $this->notAllowNames)) {
            $this->notAllowNames[] = $name;
        }
    }

    /**
     * 设置只读的属性名
     * @param array $names 属性名数组
     */
    public function readOnly(array $names)
    {
        $this->readOnlyNames = $names;
    }

    /**
     * 设置属性是否全部只读
     * @param bool $readOnlyAll 是否全部只读
     */
    public function readOnlyAll(bool $readOnlyAll = true)
    {
        $this->readOnlyAll = $readOnlyAll;
    }

    /**
     * 设置只写的属性名
     * @param array $names 属性名数组
     */
    public function writeOnly(array $names)
    {
        $this->writeOnlyNames = $names;
    }

    /**
     * 设置属性是否全部只写
     * @param bool $writeOnlyAll 是否全部只写
     */
    public function writeOnlyAll(bool $writeOnlyAll = true)
    {
        $this->writeOnlyAll = $writeOnlyAll;
    }

    /**
     * 校验属性不为只读
     * @param string $name 属性名
     */
    protected function assertNotReadOnly(string $name)
    {
        if ($this->readOnlyAll) {
            throw new OutOfBoundsException("属性都为只读！");
        }
        if ($this->readOnlyNames && in_array($name, $this->readOnlyNames)) {
            throw new OutOfBoundsException("属性：$name 为只读！");
        }
    }

    /**
     * 校验属性不为只写
     * @param string $name 属性名
     */
    protected function assertNotWriteOnly(string $name)
    {
        if ($this->writeOnlyAll) {
            throw new OutOfBoundsException("属性都为只写！");
        }
        if ($this->writeOnlyNames && in_array($name, $this->writeOnlyNames)) {
            throw new OutOfBoundsException("属性：$name 为只写！");
        }
    }

    /**
     * 校验属性名的合法性
     * @param string $name 属性名
     */
    protected function assertAllow(string $name)
    {
        if (in_array($name, $this->notAllowNames)) {
            throw new OutOfBoundsException("不允许的属性：$name");
        }
        if (!is_null($this->allowNames)) {
            if (!in_array($name, $this->allowNames)) {
                throw new OutOfBoundsException("不允许的属性：$name");
            }
        }
    }
}
