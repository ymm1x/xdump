<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ymm1x\XDump\Dumper;

// MEMO:
// This script will autoload according to composer.json settings.

// Declare global shorthand function.
if (!function_exists('d')) {
    function d(...$args): void
    {
        Dumper::dump(...$args);
    }
}
