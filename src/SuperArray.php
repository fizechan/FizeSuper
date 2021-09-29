<?php

namespace fize\super;

use ArrayObject;

/**
 * 超级数组
 */
class SuperArray extends ArrayObject
{

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
