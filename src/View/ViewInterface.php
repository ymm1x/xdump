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

/**
 * Interface ViewInterface.
 */
interface ViewInterface
{
    /**
     * Make this view a content string.
     *
     * @param string[] $viewVars
     * @param array $options
     * @return string
     */
    public function evaluate(array $viewVars = [], array $options = []): string;
}