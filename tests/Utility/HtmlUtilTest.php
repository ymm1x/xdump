<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ymm1x\XDump\Utility;

use Ymm1x\XDump\AppTestCase;

class HtmlUtilTest extends AppTestCase
{
    public function test_capture()
    {
        $actual = HtmlUtil::escape('<span>hello</span>');
        $expected = '&lt;span&gt;hello&lt;/span&gt;';
        $this->assertSame($expected, $actual);
    }
}