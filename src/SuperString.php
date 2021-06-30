<?php

namespace fize\super;

/**
 * 超级字符串
 */
class SuperString
{
    /**
     * 检查指定的字节流在指定的编码里是否有效
     *
     * 该方法能有效避免所谓的"无效编码攻击（Invalid Encoding Attack）"。
     * 参数 `$var` :
     *   如果省略了参数 `$var` ，此函数会检查所有来自最初请求所有的输入。
     * @param string $var      要检查的字节流
     * @param string $encoding 期望的编码
     * @return bool
     */
    public static function checkEncoding($var = null, $encoding = null)
    {
        return mb_check_encoding($var, $encoding);
    }

    /**
     * 获取特定字符
     * @param int    $cp       字符编码
     * @param string $encoding 编码
     * @return string
     * @since PHP7.2
     */
    public static function chr($cp, $encoding)
    {
        return mb_chr($cp, $encoding);
    }

    /**
     * 对字符串进行大小写转换,转换模式由 mode 指定。
     *
     * 参数 `$mode` :
     *   可以是 MB_CASE_UPPER、 MB_CASE_LOWER 和 MB_CASE_TITLE 的其中一个
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $str      要转化的字符串
     * @param int    $mode     转换的模式
     * @param string $encoding 字符编码
     * @return string
     */
    public static function convertCase($str, $mode, $encoding = null)
    {
        return mb_convert_case($str, $mode, $encoding);
    }

    /**
     * 转换字符的编码
     *
     * 参数 `$from_encoding` :
     *   如果没有提供，则会使用内部（internal）编码。
     * @param string $str           要转码的字符串
     * @param string $to_encoding   要转换成的编码类型。
     * @param string $from_encoding 原编码
     * @return string
     */
    public static function convertEncoding($str, $to_encoding, $from_encoding = null)
    {
        if ($from_encoding) {
            return mb_convert_encoding($str, $to_encoding, $from_encoding);
        }
        return mb_convert_encoding($str, $to_encoding);
    }

    /**
     * 将“假名”从另一个转换为另一个(“zen-kaku”、“han-kaku”等等)
     *
     * 参数 `$encoding` :
     *   如果没有提供，则会使用内部（internal）编码。
     * @param string $str      要转码的字符串
     * @param string $option   转码选项
     * @param string $encoding 原编码
     * @return string
     */
    public static function convertKana($str, $option = 'KV', $encoding = null)
    {
        if ($encoding) {
            return mb_convert_kana($str, $option, $encoding);
        }
        return mb_convert_kana($str, $option);
    }

    /**
     * 转换一个或多个变量的字符编码
     *
     * 该方法假设所有的参数都具有同样的编码。
     * 参数 `$vars` :
     *   可以接受 String、Array 和 Object 的类型。
     * @param string $to_encoding   指定编码
     * @param string $from_encoding 原编码
     * @param mixed  ...$vars       要转换的变量的引用。
     * @return string 转换前的字符编码
     * @since PHP5.6
     */
    public static function convertVariables($to_encoding, $from_encoding, &...$vars)
    {
        return mb_convert_variables($to_encoding, $from_encoding, ...$vars);
    }

    /**
     * 解码 MIME 头字段中的字符串
     * @param string $str 要解码的字符串
     * @return string
     */
    public static function decodeMimeheader($str)
    {
        return mb_decode_mimeheader($str);
    }

    /**
     * 根据 HTML 数字字符串解码成字符
     *
     * 参数 `$encoding` :
     *   如果省略参数 `$encoding` ，则使用内部字符编码。
     * @param string $str      要解码的字符串
     * @param array  $convmap  指定了要转换的代码区域。
     * @param string $encoding 字符编码。
     * @return string
     */
    public static function decodeNumericentity($str, array $convmap, $encoding = null)
    {
        return mb_decode_numericentity($str, $convmap, $encoding);
    }

    /**
     * 检测字符的编码
     *
     * 编码顺序可以由数组或者逗号分隔的列表字符串指定
     * @param string       $str           待检查的字符串
     * @param array|string $encoding_list 字符编码列表
     * @param bool         $strict        是否严格地检测编码
     * @return string
     */
    public static function detectEncoding($str, $encoding_list = null, $strict = false)
    {
        return mb_detect_encoding($str, $encoding_list, $strict);
    }

    /**
     * 设置/获取 字符编码的检测顺序
     *
     * 设置编码检测顺序时候，成功时返回 TRUE，识别时候返回 FALSE。
     * 在获取编码检测顺序的时候，会返回排序过的编码数组。
     * @param array|string $encoding_list 一个数组或者逗号分隔的字符编码列表
     * @return bool|array
     */
    public static function detectOrder($encoding_list = null)
    {
        if (is_null($encoding_list)) {
            return mb_detect_order();
        }
        return mb_detect_order($encoding_list);
    }

    /**
     * 为 MIME 头编码字符串
     *
     * 参数 `$transfer_encoding` :
     *   可以是 "B"（Base64）也可以是 "Q"（Quoted-Printable）。如果未设置，将回退为 "B"。
     * @param string $str               要编码的字符串
     * @param string $charset           指定了 str 的字符集名
     * @param string $transfer_encoding 指定了 MIME 的编码方案
     * @param string $linefeed          指定了 EOL（行尾）标记
     * @param int    $indent            首行缩进（header 里 str 前的字符数目）
     * @return string 转换后的字符串版本以 ASCII 形式表达。
     */
    public static function encodeMimeheader($str, $charset = null, $transfer_encoding = 'B', $linefeed = "\r\n", $indent = 0)
    {
        return mb_encode_mimeheader($str, $charset, $transfer_encoding, $linefeed, $indent);
    }

    /**
     * 将字符编码为HTML数字字符串引用
     * @param string $str      要编码的字符串
     * @param array  $convmap  指定要转换的代码区域。
     * @param string $encoding 指定编码
     * @param bool   $is_hex   是否为16进制字符串
     * @return string
     */
    public static function encodeNumericentity($str, array $convmap, $encoding = null, $is_hex = false)
    {
        return mb_encode_numericentity($str, $convmap, $encoding, $is_hex);
    }

    /**
     * 获取已知编码类型的别名
     * @param string $encoding 编码
     * @return string[]
     */
    public static function encodingAliases($encoding)
    {
        return mb_encoding_aliases($encoding);
    }

    /**
     * 正则表达式匹配多字节字符串
     * @param string $pattern 正则表达式
     * @param string $string  要匹配的字符串
     * @param string $option  匹配的选项
     * @return bool
     */
    public static function eregMatch($pattern, $string, $option = null)
    {
        return mb_ereg_match($pattern, $string, $option);
    }

    /**
     * 使用回调函数执行正则表达式搜索并使用多字节支持替换
     * @param string   $pattern  正则表达式
     * @param callable $callback 回调函数
     * @param string   $string   要匹配的字符串
     * @param string   $option   匹配的选项
     * @return string
     */
    public static function eregReplaceCallback($pattern, callable $callback, $string, $option = "msr")
    {
        return mb_ereg_replace_callback($pattern, $callback, $string, $option);
    }

    /**
     * 用多字节支持替换正则表达式
     * @param string $pattern     正则表达式
     * @param string $replacement 要替换成的字符串
     * @param string $string      要匹配的字符串
     * @param string $option      匹配的选项
     * @return string
     */
    public static function eregReplace($pattern, $replacement, $string, $option = "msr")
    {
        return mb_ereg_replace($pattern, $replacement, $string, $option);
    }

    /**
     * 返回下一个正则表达式匹配的起始点
     * @return int
     */
    public static function eregSearchGetpos()
    {
        return mb_ereg_search_getpos();
    }

    /**
     * 从最后一个多字节正则表达式匹配中检索结果
     * @return string[]
     */
    public static function eregSearchGetregs()
    {
        return mb_ereg_search_getregs();
    }

    /**
     * 为多字节正则表达式匹配设置字符串和正则表达式
     * @param string $string  要匹配的字符串
     * @param string $pattern 正则表达式
     * @param string $option  匹配的选项
     * @return bool
     */
    public static function eregSearchInit($string, $pattern = null, $option = null)
    {
        return mb_ereg_search_init($string, $pattern, $option);
    }

    /**
     * 返回预定义多字节正则表达式的匹配部分的位置和长度
     * @param string $pattern 正则表达式
     * @param string $option  匹配的选项
     * @return int[]
     */
    public static function eregSearchPos($pattern = null, $option = null)
    {
        return mb_ereg_search_pos($pattern, $option);
    }

    /**
     * 返回多字节正则表达式的匹配部分
     * @param string $pattern 正则表达式
     * @param string $option  匹配的选项
     * @return string[]
     */
    public static function eregSearchRegs($pattern = null, $option = null)
    {
        return mb_ereg_search_regs($pattern, $option);
    }

    /**
     * 设置下一个正则表达式匹配的起始点
     * @param int $position 起始点
     * @return bool
     */
    public static function eregSearchSetpos($position)
    {
        return mb_ereg_search_setpos($position);
    }

    /**
     * 多字节正则表达式匹配预定义的多字节字符串
     * @param string $pattern 正则表达式
     * @param string $option  匹配的选项
     * @return bool
     */
    public static function eregSearch($pattern = null, $option = null)
    {
        return mb_ereg_search($pattern, $option);
    }

    /**
     * 正则表达式匹配多字节支持
     * @param string $pattern 正则表达式
     * @param string $string  要匹配的字符串
     * @param array  $regs    匹配项将存储在该数组的元素中
     * @return int
     */
    public static function ereg($pattern, $string, array &$regs = null)
    {
        return mb_ereg($pattern, $string, $regs);
    }

    /**
     * 用多字节支持忽略大小写替换正则表达式
     * @param string $pattern 正则表达式
     * @param string $replace 要替换成的字符串
     * @param string $string  要匹配的字符串
     * @param string $option  匹配的选项
     * @return string
     */
    public static function eregiReplace($pattern, $replace, $string, $option = "msr")
    {
        return mb_eregi_replace($pattern, $replace, $string, $option);
    }

    /**
     * 正则表达式匹配多字节支持的忽略大小写
     * @param string $pattern 正则表达式
     * @param string $string  要搜索的字符串
     * @param array  $regs    匹配项将存储在该数组的元素中
     * @return int
     */
    public static function eregi($pattern, $string, array &$regs = null)
    {
        return mb_eregi($pattern, $string, $regs);
    }

    /**
     * 获取 mbstring 的内部设置
     * @param string $type 指定返回类型
     * @return mixed 如果没有指定 type 将返回类型信息的数组，否则将返回指定 type 的信息。
     */
    public static function getInfo($type = null)
    {
        return mb_get_info($type);
    }

    /**
     * 检测 HTTP 输入字符的编码
     *
     * 参数 `$type` :
     *   "G" 是 GET，"P" 是 POST，"C" 是 COOKIE，"S" 是 string，"L" 是 list，以及 "I" 是整个列表
     * @param string $type 设置的字符串指定了输入类型
     * @return mixed 如果没有处理过任何指定的 HTTP 输入，它将返回 FALSE。
     */
    public static function httpInput($type = null)
    {
        return mb_http_input($type);
    }

    /**
     * 设置/获取 HTTP 输出字符编码
     * @param string $encoding 设置编码
     * @return mixed 如果省略了 encoding，返回当前的 HTTP 输出字符编码。否则成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public static function httpOutput($encoding = null)
    {
        return mb_http_output($encoding);
    }

    /**
     * 设置/获取内部字符编码
     * @param string $encoding 设置编码
     * @return mixed 如果省略了 encoding，返回当前的内部字符编码。否则成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public static function internalEncoding($encoding = null)
    {
        return mb_internal_encoding($encoding);
    }

    /**
     * 设置/获取当前的语言
     *
     * 有效的语言有："Japanese","ja","English","en" 和 "uni"（UTF-8）。
     * @param string $language 用于编码邮件信息
     * @return mixed 如果设置了 language，并且 language 是有效的，它将返回 TRUE,否则将返回 FALSE。
     */
    public static function language($language = null)
    {
        return mb_language($language);
    }

    /**
     * 返回所有支持编码的数组
     * @return array
     */
    public static function listEncodings()
    {
        return mb_list_encodings();
    }

    /**
     * 获取字符的代码点
     * @param string $str      字符串
     * @param string $encoding 编码
     * @return int
     * @since PHP7.2
     */
    public static function ord($str, $encoding)
    {
        return mb_ord($str, $encoding);
    }

    /**
     * 在输出缓冲中转换字符编码的回调函数
     * @param string $contents 输出缓冲的内容
     * @param int    $status   输出缓冲的状态
     * @return string
     */
    public static function outputHandler($contents, $status)
    {
        return mb_output_handler($contents, $status);
    }

    /**
     * 解析 GET/POST/COOKIE 数据并设置全局变量
     * @param string $encoded_string URL 编码过的数据
     * @param array  $result         一个数组，包含解码过的、编码转换后的值。
     * @return bool
     */
    public static function parseStr($encoded_string, array &$result = null)
    {
        return mb_parse_str($encoded_string, $result);
    }

    /**
     * 获取 MIME 字符串
     * @param string $encoding 要检查的字符串
     * @return string
     */
    public static function preferredMimeName($encoding)
    {
        return mb_preferred_mime_name($encoding);
    }

    /**
     * 设置/获取多字节正则表达式的字符编码
     * @param string $encoding 编码
     * @return bool|string 设置时返回true或false，获取时返回string
     */
    public static function regexEncoding($encoding = null)
    {
        return mb_regex_encoding($encoding);
    }

    /**
     * 设置/获取mbregex函数的默认选项
     * @param string $options 选项
     * @return string
     */
    public static function regexSetOptions($options = null)
    {
        return mb_regex_set_options($options);
    }

    /**
     * 清理格式不正确的字符
     * @notice 本函数还未编写文档，仅有参数列表
     * @param string $str      字符串
     * @param string $encoding 编码
     * @return string
     * @since  PHP7.2
     */
    public static function scrub($str, $encoding)
    {
        return mb_scrub($str, $encoding);
    }

    /**
     * 发送编码过的邮件
     *
     * 可通过逗号分隔地址的 `$to` 来指定多个收件人。该参数不会被自动编码
     * 参数 `$additional_parameter` :
     *   在使用 sendmail 时对设置正确的返回路径头很有帮助
     * @param string $to                   被发送到该邮件地址
     * @param string $subject              邮件标题
     * @param string $message              邮件消息
     * @param string $additional_headers   要插入到电子邮件标题末尾的字符串。
     * @param string $additional_parameter MTA 命令行参数
     * @return bool
     */
    public static function sendMail($to, $subject, $message, $additional_headers = null, $additional_parameter = null)
    {
        return mb_send_mail($to, $subject, $message, $additional_headers, $additional_parameter);
    }

    /**
     * 使用正则表达式分割多字节字符串
     * @param string $pattern 正则表达式
     * @param string $string  待分割的字符串
     * @param int    $limit   最多分割为 limit 个元素
     * @return array
     */
    public static function split($pattern, $string, $limit = null)
    {
        return mb_split($pattern, $string, $limit);
    }

    /**
     * 获取字符的一部分
     *
     * 参数 `$start` :
     *   负表示返回的字符串是从 str 末尾处第 start 个字节开始的
     * @param string $str      字符串
     * @param int    $start    开始偏移量
     * @param int    $length   长度
     * @param string $encoding 编码
     * @return string
     */
    public static function strcut($str, $start, $length = null, $encoding = null)
    {
        return mb_strcut($str, $start, $length, $encoding);
    }

    /**
     * 获取按指定宽度截断的字符串
     *
     * 参数 `$start` :
     *   从这些字符数开始的截取字符串。（默认是 0 个字符）。
     *   如果 start 是负数，就是字符串结尾处的字符数。
     * @param string $str        字符串
     * @param int    $start      开始位置的偏移
     * @param int    $width      所需修剪的宽度。负数的宽度是从字符串结尾处统计的。
     * @param string $trimmarker 当字符串被截短的时候，将此字符串添加到截短后的末尾。
     * @param string $encoding   字符编码。如果省略，则使用内部字符编码
     * @return string
     */
    public static function strimwidth($str, $start, $width, $trimmarker = null, $encoding = null)
    {
        return mb_strimwidth($str, $start, $width, $trimmarker, $encoding);
    }

    /**
     * 大小写不敏感地查找字符串在另一个字符串中首次出现的位置
     *
     * 参数 `$offset` :
     *   如果是负数，就从字符串的尾部开始统计。
     * 参数 `$encoding` :
     *   如果省略了它，将使用内部字符编码。
     * @param string $haystack 被查找的字符串
     * @param string $needle   要查找这个字符串
     * @param int    $offset   开始搜索的位置
     * @param string $encoding 使用的字符编码名称
     * @return int|false 没找到返回false
     */
    public static function stripos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return mb_stripos($haystack, $needle, $offset, $encoding);
    }

    /**
     * 大小写不敏感地查找字符串在另一个字符串里的首次出现
     *
     * 参数 `$encoding` :
     *   如果省略了它，将使用内部字符编码。
     * @param string $haystack      被查找的字符串
     * @param string $needle        要查找这个字符串
     * @param bool   $before_needle 决定这个函数返回 haystack 的哪一部分
     * @param string $encoding      使用的字符编码名称
     * @return string|false 返回指定部分字符串，没找到时返回false
     */
    public static function stristr($haystack, $needle, $before_needle = false, $encoding = null)
    {
        return mb_stristr($haystack, $needle, $before_needle, $encoding);
    }

    /**
     * 获取字符串的长度
     * @param string $str      字符串
     * @param string $encoding 编码
     * @return int|false 如果给定的 encoding 无效则返回 FALSE
     */
    public static function strlen($str, $encoding = null)
    {
        return mb_strlen($str, $encoding);
    }

    /**
     * 查找字符串在另一个字符串中首次出现的位置
     *
     * 参数 `$offset` :
     *   如果没有提供该参数，将会使用 0。负数的 offset 会从字符串尾部开始统计。
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack 被查找的字符串
     * @param string $needle   要查找这个字符串
     * @param int    $offset   搜索位置的偏移
     * @param string $encoding 字符编码
     * @return int|false 没找到时返回false
     */
    public static function strpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return mb_strpos($haystack, $needle, $offset, $encoding);
    }

    /**
     * 查找指定字符在另一个字符串中最后一次的出现
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack      被查找的字符串
     * @param string $needle        要查找这个字符串
     * @param bool   $before_needle 决定这个函数返回 haystack 的哪一部分
     * @param string $encoding      使用的字符编码名称
     * @return string|false 返回指定部分字符串，没找到时返回false
     */
    public static function strrchr($haystack, $needle, $before_needle = false, $encoding = null)
    {
        return mb_strrchr($haystack, $needle, $before_needle, $encoding);
    }

    /**
     * 大小写不敏感地查找指定字符在另一个字符串中最后一次的出现
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack      被查找的字符串
     * @param string $needle        要查找这个字符串
     * @param bool   $before_needle 决定这个函数返回 haystack 的哪一部分
     * @param string $encoding      使用的字符编码名称
     * @return string|false 返回指定部分字符串，没找到时返回false
     */
    public static function strrichr($haystack, $needle, $before_needle = false, $encoding = null)
    {
        return mb_strrichr($haystack, $needle, $before_needle, $encoding);
    }

    /**
     * 大小写不敏感地在字符串中查找一个字符串最后出现的位置
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack 被查找的字符串
     * @param string $needle   要查找这个字符串
     * @param int    $offset   开始搜索的位置
     * @param string $encoding 使用的字符编码名称
     * @return int|false 没找到时返回false
     */
    public static function strripos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return mb_strripos($haystack, $needle, $offset, $encoding);
    }

    /**
     * 查找字符串在一个字符串中最后出现的位置
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack 被查找的字符串
     * @param string $needle   要查找这个字符串
     * @param int    $offset   开始搜索的位置
     * @param string $encoding 使用的字符编码名称
     * @return int|false 没找到时返回false
     */
    public static function strrpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return mb_strrpos($haystack, $needle, $offset, $encoding);
    }

    /**
     * 查找字符串在另一个字符串里的首次出现,并返回指定部分字符串
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack      被查找的字符串
     * @param string $needle        要查找这个字符串
     * @param bool   $before_needle 决定这个函数返回 haystack 的哪一部分
     * @param string $encoding      使用的字符编码名称
     * @return string|false 没找到时返回false
     */
    public static function strstr($haystack, $needle, $before_needle = false, $encoding = null)
    {
        return mb_strstr($haystack, $needle, $before_needle, $encoding);
    }

    /**
     * 使字符串小写
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $str      字符串
     * @param string $encoding 使用的字符编码名称
     * @return string
     */
    public static function strtolower($str, $encoding = null)
    {
        return mb_strtolower($str, $encoding);
    }

    /**
     * 使字符串大写
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $str      字符串
     * @param string $encoding 使用的字符编码名称
     * @return string
     */
    public static function strtoupper($str, $encoding = null)
    {
        return mb_strtoupper($str, $encoding);
    }

    /**
     * 返回字符串的宽度,多字节字符通常是单字节字符的两倍宽度。
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $str      字符串
     * @param string $encoding 使用的字符编码名称
     * @return int
     */
    public static function strwidth($str, $encoding = null)
    {
        return mb_strwidth($str, $encoding);
    }

    /**
     * 设置/获取替代字符
     * @param mixed $substrchar 指定替代选项
     * @return mixed 设置时，在成功时返回 TRUE，失败时返回 FALSE。否则返回当前设置。
     */
    public static function substituteCharacter($substrchar = null)
    {
        return mb_substitute_character($substrchar);
    }

    /**
     * 统计字符串出现的次数
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $haystack 被查找的字符串
     * @param string $needle   要查找这个字符串
     * @param string $encoding 使用的字符编码名称
     * @return int
     */
    public static function substrCount($haystack, $needle, $encoding = null)
    {
        return mb_substr_count($haystack, $needle, $encoding);
    }

    /**
     * 获取部分字符串
     *
     * 参数 `$encoding` :
     *   如果省略，则使用内部字符编码。
     * @param string $str      字符串
     * @param int    $start    开始下标
     * @param int    $length   获取长度
     * @param string $encoding 使用的字符编码
     * @return string
     */
    public static function substr($str, $start, $length = null, $encoding = null)
    {
        return mb_substr($str, $start, $length, $encoding);
    }
}
