<?php
namespace fize\super;

/**
 * 超级基类
 */
class SuperStdClass
{

    private $data = [];

    public function __construct(array $keyValues)
    {
        foreach ($keyValues as $key => $value) {
            $this->data[$key] = $value;
        }
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
}
