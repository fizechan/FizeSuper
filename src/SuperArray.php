<?php

namespace Fize\Super;

/**
 * 超级数组
 */
class SuperArray
{

    /**
     * @var array 数组
     */
    protected $array;

    /**
     * 初始化
     * @param array $array 数组
     */
    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    /**
     * 将数组中的所有键名修改为全大写或小写
     * @param int  $case    0-小写；1-大写；
     * @param bool $inplace 是否改变原数组
     * @return array
     */
    public function changeKeyCase(int $case = CASE_LOWER, bool $inplace = true)
    {
        $array = array_change_key_case($this->array, $case);
        if ($inplace) {
            $this->array = $array;
        }
        return $array;
    }

    /**
     * 多维数组转一维数组，键名使用下划线合并
     * @param string $merger             合并符
     * @param bool   $keep_numeric_array 是否保持数值数组
     * @param bool   $inplace            是否改变原数组
     * @return array
     */
    public function toLevel1(string $merger = '_', bool $keep_numeric_array = true, bool $inplace = true): array
    {
        $array = self::toLevel1Array($this->array, $merger, $keep_numeric_array);
        if ($inplace) {
            $this->array = $array;
        }
        return $array;
    }

    /**
     * 多维数组转一维数组，键名使用【合并符】$merger进行合并
     * @param array  $array              多维数组
     * @param string $merger             合并符
     * @param string $prefix             前缀
     * @param bool   $keep_numeric_array 是否保持数值数组
     * @return array
     */
    protected static function toLevel1Array(array $array, string $merger = '_', bool $keep_numeric_array = true, string $prefix = ''): array
    {
        $lv1array = [];
        foreach ($array as $key => $value) {
            if ($prefix) {
                $key = $prefix . $merger . $key;
            }
            if (is_array($value)) {
                if (self::isNumericArray($value) && $keep_numeric_array) {
                    $lv1array[$key] = $value;
                } else {
                    $lv1array = array_merge($lv1array, self::toLevel1Array($value, $merger, $keep_numeric_array, $key));
                }
            } else {
                $lv1array[$key] = $value;
            }
        }
        return $lv1array;
    }

    /**
     * 判断数组是不是普通数值数组
     * @param array $array 数组
     * @return bool
     */
    public static function isNumericArray(array $array)
    {
        $index = 0;
        foreach (array_keys($array) as $key) {
            if ($index++ !== $key) {
                return false;
            }
        }
        return true;
    }

}
