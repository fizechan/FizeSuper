<?php

namespace Fize\Super;

use ArrayObject;

/**
 * 超级数组
 */
class SuperArray extends ArrayObject
{

    /**
     * 将数组中的所有键名修改为全大写或小写
     * @param int  $case     0-小写；1-大写；
     * @param bool $exchange 是否变换原数组
     * @return array
     */
    public function changeKeyCase(int $case = CASE_LOWER, bool $exchange = true): array
    {
        $array = array_change_key_case($this->getArrayCopy(), $case);
        if ($exchange) {
            $this->exchangeArray($array);
        }
        return $array;
    }

    /**
     * 将数组分割成多个
     * @param int  $size          每个数组的单元数目
     * @param bool $preserve_keys 设为 true，可以使 PHP 保留输入数组中原来的键名。
     * @return array
     */
    public function chunk(int $size, bool $preserve_keys = false): array
    {
        return array_chunk($this->getArrayCopy(), $size, $preserve_keys);
    }

    /**
     * 多维数组转一维数组，键名使用下划线合并
     * @param array  $array  原数组
     * @param string $prefix 键名前缀
     * @return array
     */
    public static function toLevel1(array $array, string $prefix = ''): array
    {
        $lv1array = [];
        foreach ($array as $key => $value) {
            if ($prefix) {
                $key = $prefix . '_' . $key;
            }
            if (is_array($value)) {
                $lv1array = array_merge($lv1array, self::toLevel1($value, $key));
            } else {
                $lv1array[$key] = $value;
            }
        }
        return $lv1array;
    }

}
