<?php
/*
 *    Copyright 2012-2016 Youzan, Inc.
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */

namespace Zan\Framework\Utilities\Types;

use Zan\Framework\Utilities\Math\DecimalConverter;
use Zan\Framework\Foundation\Exception\System\InvalidArgumentException;

class Alias
{

    public static function get($int32)
    {
        if ($int32 > (pow(2,32)-1))
        {
            throw new InvalidArgumentException('参数不合法');
        }
        //获取随机数
        $random32 = self::genRandom32();
        //转换二进制
        $int32 = base_convert($int32, 10, 2);
        $random32 = base_convert($random32, 10, 2);
        //混淆
        while (strlen($int32) < 32) {
            $int32 = 0 . $int32;
        }
        $arr1 = str_split($int32, 4);
        $arr2 = str_split($random32, 4);
        $arr = array_map(function($randomPart,$intPart){
            return $randomPart.$intPart;
        }, $arr2, $arr1);
        $result64 = implode($arr);

        //转换成36进制
        $result64 = DecimalConverter::convert($result64,2,36);
        return $result64;
    }

    public static function parse($alias64)
    {
        if (!self::isValid($alias64)) {
            return null;
        }
        //转换成2进制
        $alias64 = DecimalConverter::convert($alias64,36,2);
        $int32 = '';
        for ($i=4; $i < 64; $i+=8) {
            $int32 .= substr($alias64, $i, 4);
        }
        return DecimalConverter::toDec($int32,2);
    }

    public static function genRandom32()
    {
        $random = crc32(microtime(TRUE) . Str::randomString('alnum', 50));
        return $random | pow(2, 31);
    }

    public static function isValid($alias)
    {
        if (strlen($alias) !== 13) {
            return false;
        }
        return true;
    }
}