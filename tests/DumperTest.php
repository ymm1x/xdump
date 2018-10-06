<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ymm1x\XDump;

use Ymm1x\XDump\Utility\CaptureUtil;

class DumperTest extends AppTestCase
{
    public function test_dump_cli()
    {
        Dumper::setClient(Dumper::CLIENT_TYPE_CLI);
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('bbb');
        }));
        $this->assertContains('ymm1x/xdump/tests/DumperTest.php', $actual[0]);
        $this->assertSame('string(3) "bbb"', $actual[1]);
        $this->assertSame('', $actual[2]);
    }

    public function test_dump_html()
    {
        Dumper::setClient(Dumper::CLIENT_TYPE_BROWSER);
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('bbb');
        }));
        $this->assertSame('<style>', trim($actual[0]));

        // Reading css and js is done only for the first time
        Dumper::setClient(Dumper::CLIENT_TYPE_BROWSER);
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('bbb');
        }));
        $this->assertNotSame('<style>', trim($actual[0]));
    }
}