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
     * @param int  $case
     * @param bool $change
     * @return array
     */
    public function changeKeyCase(int $case = CASE_LOWER, bool $change = true)
    {
        $array = array_change_key_case($this->array, $case);
        if ($change) {
            $this->array = $array;
        }
        return $array;
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
