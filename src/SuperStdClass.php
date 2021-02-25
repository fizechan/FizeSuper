<?php
namespace fize\super;

/**
 * 超级基类
 */
class SuperStdClass
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
     * @param $keyValues
     * @return static
     */
    public static function sets($keyValues)
    {
        $obj = new static();
        foreach ($keyValues as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }
}
