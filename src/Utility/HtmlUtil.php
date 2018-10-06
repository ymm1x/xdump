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
 * Html utilities.
 */
class HtmlUtil
{
    /**
     * Convert special characters to HTML entities.
     *
     * @param string $str
     * @return string
     */
    static function escape(string $str): string
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
