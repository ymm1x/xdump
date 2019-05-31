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

use Ymm1x\XDump\Utility\CaptureUtil;

/**
 * View class has the ability to render templates.
 */
class View implements ViewInterface
{
    /** @var string Directory separator */
    private const DS = DIRECTORY_SEPARATOR;
    /** @var string Base dir of template */
    protected $_baseDir;
    /** @var string */
    protected $_viewName;

    /**
     * View constructor.
     *
     * @param string $viewName A view filename without extension
     * @param string $baseDir Optional
     */
    public function __construct(string $viewName, string $baseDir = null)
    {
        if ($baseDir === null) {
            $this->_baseDir = dirname(__DIR__)
                . self::DS . 'Resource'
                . self::DS . 'template';
        } else {
            $this->_baseDir = $baseDir;
        }
        $this->_viewName = $viewName;
    }

    /**
     * @return string
     */
    protected function _getTemplatePath(): string
    {
        return $this->_baseDir . self::DS . $this->_viewName . '.php';
    }

    /**
     * @inheritdoc Implementation of ViewInterface
     */
    public function evaluate(array $viewVars = [], array $options = []): string
    {
        return CaptureUtil::capture(function () use ($viewVars) {
            // import variables into the current symbol table
            extract($viewVars, EXTR_SKIP);
            // load template on this scope with extracted variables
            /** @noinspection PhpIncludeInspection */
            include $this->_getTemplatePath();
        });
    }
}
