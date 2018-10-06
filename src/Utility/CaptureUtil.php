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

/**
 * Capturing utilities.
 */
class CaptureUtil
{
    /**
     * Capture the execution result of any logic as a string.
     *
     * @param callable $fn An any logic that includes rendering
     * @return string Captured string
     */
    public static function capture(callable $fn): string
    {
        ob_start();
        $fn();
        return ob_get_clean();
    }
}