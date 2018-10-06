<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ymm1x\XDump\View;

use Ymm1x\XDump\AppTestCase;
use Ymm1x\XDump\Utility\CaptureUtil;

class ViewRendererTest extends AppTestCase
{
    /** @var string Directory separator */
    private const DS = DIRECTORY_SEPARATOR;

    public function test_evaluate()
    {
        $expected = <<< 'EOT'
var1 is 111
var2 is 222
EOT;

        $actual = CaptureUtil::capture(function () {
            $viewName = 'test_template_simple';
            $baseDir = dirname(__DIR__)
                . self::DS . 'Resource'
                . self::DS . 'template';
            $view = new View($viewName, $baseDir);
            $viewVars = ['var1' => '111', 'var2' => '222'];
            (new ViewRenderer($view))->render($viewVars);
        });

        $this->assertSame($expected, $actual);
    }
}