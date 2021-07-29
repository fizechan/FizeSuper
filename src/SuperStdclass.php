<?php
namespace fize\super;

use stdClass;

/**
 * 超级基类
 */
class SuperStdclass extends stdClass
{

    private $data = [];

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
     * 使用数组对stdClass进行赋值，每个键值对对应一个属性
     * @param array $keyValues 键值对
     * @return static
     */
    public static function sets(array $keyValues)
    {
        $obj = new static();
        foreach ($keyValues as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }
}
