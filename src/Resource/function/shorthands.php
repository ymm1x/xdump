<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('d')) {
    function d(...$args): void
    {
        call_user_func_array('\Ymm1x\XDump\Dumper::dump', $args);
    }
} else if (!function_exists('dd')) { // Retry declare
    function dd(...$args): void
    {
        call_user_func_array('\Ymm1x\XDump\Dumper::dump', $args);
    }
}

