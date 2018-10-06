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

class CaptureUtilTest extends AppTestCase
{
    public function test_capture()
    {
        $expected = $_SERVER['REQUEST_TIME'];
        $actual = CaptureUtil::capture(function () {
            echo $_SERVER['REQUEST_TIME'];
        });
        $this->assertEquals($expected, $actual);
    }
}