<?php


use fize\super\SuperString;
use PHPUnit\Framework\TestCase;

class TestSuperString extends TestCase
{
    public function testCheckEncoding()
    {
        $rst = SuperString::checkEncoding("\x00\xE3", 'UTF-8');
        var_dump($rst);
        self::assertIsBool($rst);
    }

    public function testChr()
    {
        $chr = SuperString::chr(49, 'UTF-8');
        var_dump($chr);
        self::assertIsString($chr);
    }

    public function testConvertCase()
    {
        $str = 'I am A Chinese!';

        $str1 = SuperString::convertCase($str, MB_CASE_UPPER);
        self::assertEquals('I AM A CHINESE!', $str1);

        $str2 = SuperString::convertCase($str, MB_CASE_LOWER);
        self::assertEquals('i am a chinese!', $str2);

        $str3 = SuperString::convertCase($str, MB_CASE_TITLE);
        self::assertEquals('I Am A Chinese!', $str3);
    }

    public function testConvertEncoding()
    {
        $str = '我是中国人!';
        $str1 = SuperString::convertEncoding($str, 'UTF-8');
        var_dump($str1);
        self::assertIsString($str1);
    }

    public function testConvertKana()
    {
        $str = 'kana';
        $str = SuperString::convertKana($str, 'KVC');
        var_dump($str);
        self::assertIsString($str);
    }

    public function testConvertVariables()
    {
        $str1 = '1';
        $str2 = '二';
        $str3 = 'three';
        $rst = SuperString::convertVariables('GBK', 'UTF-8', $str1, $str2, $str3);
        var_dump($rst);
        var_dump($str1);
        var_dump($str2);
        var_dump($str3);
        self::assertEquals('UTF-8', $rst);
    }

    public function testDecodeMimeheader()
    {
        $mime = SuperString::decodeMimeheader('Subject: =?UTF-8?B?UHLDvGZ1bmcgUHLDvGZ1bmc=?=');
        var_dump($mime);
        self::assertIsString($mime);
    }

    public function testDecodeNumericentity()
    {
        $convmap = [0x0, 0xffff, 0, 0xffff];
        $msg = '';
        for ($i = 0; $i < 1000; $i++) {
            //$msg .= MbString::decodeNumericentity('&#'.$i.';', $convmap, 'UTF-8');
            $msg .= SuperString::decodeNumericentity('&#' . $i . ';', $convmap);
        }
        var_dump($msg);
        self::assertIsString($msg);
    }

    public function testDetectEncoding()
    {
        $encoding = SuperString::detectEncoding('我是中国人', 'auto');
        var_dump($encoding);
        self::assertIsString($encoding);
    }

    public function testDetectOrder()
    {
        $rst1 = SuperString::detectOrder('eucjp-win,sjis-win,UTF-8');
        var_dump($rst1);
        self::assertIsBool($rst1);

        $ary[] = 'ASCII';
        $ary[] = 'JIS';
        $ary[] = 'EUC-JP';
        $rst2 = SuperString::detectOrder($ary);
        var_dump($rst2);
        self::assertIsBool($rst2);

        $rst3 = SuperString::detectOrder();
        var_dump($rst3);
        self::assertIsArray($rst3);
    }

    public function testEncodeMimeheader()
    {
        $name = ''; // kanji
        $mbox = 'kru';
        $doma = 'gtinn.mon';
        $addr = SuperString::encodeMimeheader($name, 'UTF-7', 'Q') . ' <' . $mbox . '@' . $doma . '>';
        var_dump($addr);
        self::assertIsString($addr);
    }

    public function testEncodeNumericentity()
    {
        $str1 = '待编码字符串';
        $convmap = [0x80, 0xff, 0, 0xff];
        $str2 = SuperString::encodeNumericentity($str1, $convmap, 'ISO-8859-1');
        var_dump($str2);
        self::assertIsString($str2);
    }

    public function testEncodingAliases()
    {
        $encoding = 'ASCII';
        $aliases = SuperString::encodingAliases($encoding);
        var_dump($aliases);
        self::assertIsArray($aliases);
    }

    public function testEregMatch()
    {
        $needle = '[';
        $haystack = 'some_array[]';
        $test = SuperString::eregMatch('.*' . preg_quote($needle), $haystack);
        self::assertTrue($test);
    }

    public function testEregReplaceCallback()
    {

    }

    public function testLanguage()
    {

    }

    public function testStrrpos()
    {

    }


    public function testSubstr()
    {

    }

    public function testOutputHandler()
    {

    }


    public function testRegexSetOptions()
    {

    }

    public function testEregSearchRegs()
    {

    }

    public function testRegexEncoding()
    {

    }

    public function testStrrchr()
    {

    }

    public function testStrtolower()
    {

    }


    public function testStrripos()
    {

    }

    public function testStripos()
    {

    }

    public function testEregSearchSetpos()
    {

    }


    public function testOrd()
    {

    }

    public function testScrub()
    {

    }


    public function testEregReplace()
    {

    }

    public function testListEncodings()
    {

    }

    public function testPreferredMimeName()
    {

    }

    public function testStrstr()
    {

    }


    public function testSubstrCount()
    {

    }

    public function testHttpInput()
    {

    }

    public function testStrrichr()
    {

    }


    public function testStristr()
    {

    }

    public function testSendMail()
    {

    }

    public function testSubstituteCharacter()
    {

    }


    public function testEregSearchPos()
    {

    }

    public function testEregSearch()
    {

    }

    public function testInternalEncoding()
    {

    }


    public function testSplit()
    {

    }

    public function testStrcut()
    {

    }

    public function testStrtoupper()
    {

    }

    public function testEregi()
    {

    }


    public function testStrwidth()
    {

    }

    public function testEregiReplace()
    {

    }

    public function testStrpos()
    {

    }

    public function testHttpOutput()
    {

    }


    public function testEregSearchInit()
    {

    }

    public function testStrlen()
    {

    }

    public function testEregSearchGetregs()
    {

    }

    public function testGetInfo()
    {

    }

    public function testParseStr()
    {

    }

    public function testEregSearchGetpos()
    {

    }

    public function testStrimwidth()
    {

    }

    public function testEreg()
    {

    }
}
