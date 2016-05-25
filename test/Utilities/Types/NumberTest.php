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

namespace Zan\Framework\Test\Utilities\Types;

use Zan\Framework\Utilities\Types\Number;

class NumberTest extends \TestCase {
    public function testFloatToStingWork()
    {
        $float  = 0.03;
        $expect = '3';
        $result = Number::floatToString($float);

        $this->assertEquals($expect, $result, 'Number::floatToString fail');

        $float  = 1e7;
        $expect = '10000000';
        $result = Number::floatToString($float);

        $this->assertEquals($expect, $result, 'Number::floatToString fail');

        $float  = 3.1233;
        $expect = '31233';
        $result = Number::floatToString($float);

        $this->assertEquals($expect, $result, 'Number::floatToString fail');
    }
}