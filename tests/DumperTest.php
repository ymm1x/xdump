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

        // Case1: Only one argument
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('bbb');
        }));
        $this->assertContains('tests/DumperTest.php', $actual[0]);
        $this->assertSame('string(3) "bbb"', $actual[1]);
        $this->assertSame('', $actual[2]);

        // Case2: Multiple arguments
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('aaa', 'bbb');
        }));
        $this->assertContains('tests/DumperTest.php', $actual[0]);
        $this->assertSame('string(3) "aaa"', $actual[1]);
        $this->assertSame('string(3) "bbb"', $actual[2]);
        $this->assertSame('', $actual[3]);

        // Case3: Void
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump();
        }));
        $this->assertContains('tests/DumperTest.php', $actual[0]);
        $this->assertSame('void', $actual[1]);
    }

    public function test_dump_html()
    {
        Dumper::setClient(Dumper::CLIENT_TYPE_BROWSER);
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('aaa', ['bbb', 'ccc']);
        }));
        $this->assertSame('<style>', trim($actual[0]));

        // Reading css and js is done only for the first time
        Dumper::setClient(Dumper::CLIENT_TYPE_BROWSER);
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('aaa', ['bbb', 'ccc']);
        }));
        $this->assertNotSame('<style>', trim($actual[0]));
    }

    public function test_dump_auto()
    {
        $actual = explode("\n", CaptureUtil::capture(function () {
            Dumper::dump('bbb');
        }));
        $this->assertContains('tests/DumperTest.php', $actual[0]);
        $this->assertSame('string(3) "bbb"', $actual[1]);
        $this->assertSame('', $actual[2]);
    }
}