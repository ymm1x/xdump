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

/**
 * Caller information.
 */
class Caller
{
    /** @var string File path */
    private $_file;
    /** @var string Line number of file */
    private $_line;
    /** @var string Code of line */
    private $_code;

    /**
     * Create an instance from backtrace.
     *
     * @return self
     */
    public static function create(): self
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        // Skip if called via shorthand function
        $caller = (strpos($caller[1]['file'], 'src/Resource/function/shorthands.php') === false)
            ? $caller[1]
            : $caller[2];
        $file = $caller['file'];
        $line = $caller['line'];
        $code = static::readCodeLine($file, $line);
        return new self($file, $line, $code);
    }

    /**
     * Read code on the specified line.
     *
     * @param string $file
     * @param string $line
     * @return null|string
     */
    public static function readCodeLine(string $file, string $line): ?string
    {
        $file = @file($file);
        return $file[$line - 1] ?? null;
    }

    /**
     * Caller constructor.
     *
     * @param string $file
     * @param string $line
     * @param string $code
     */
    public function __construct(string $file, string $line, string $code)
    {
        $this->_file = $file;
        $this->_line = $line;
        $this->_code = $code;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->_file;
    }

    /**
     * @return string
     */
    public function getLine(): string
    {
        return $this->_line;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->_code;
    }
}