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
 * Class ViewRenderer.
 */
class ViewRenderer
{
    /** @var ViewInterface */
    private $_view;

    /**
     * ViewRenderer constructor.
     *
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view)
    {
        $this->_view = $view;
    }

    /**
     * Rendering the view.
     *
     * @param array $viewVars Variables to use on View
     */
    public function render(array $viewVars = []): void
    {
        echo $this->_view->evaluate($viewVars);
    }
}