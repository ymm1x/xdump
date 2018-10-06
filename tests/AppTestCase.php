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

use PHPUnit\Framework\TestCase;

class AppTestCase extends TestCase
{
    protected function setUp()
    {
        // Reset flags
        Dumper::setIsScriptsLoadedOnHtml(false);
        Dumper::setClient(null);
    }
}