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

use Ymm1x\XDump\Utility\CaptureUtil;
use Ymm1x\XDump\View\View;
use Ymm1x\XDump\View\ViewRenderer;

/**
 * Variable dumper utility.
 */
class Dumper
{
    /** @var string Client type: CLI */
    public const CLIENT_TYPE_CLI = 'cli';
    /** @var string Client type: Browser */
    public const CLIENT_TYPE_BROWSER = 'browser';

    /** @var bool JavaScript and CSS loaded flag */
    private static $isScriptsLoadedOnHtml = false;
    /** @var bool Client type */
    private static $clientType;

    /**
     * Dump all arguments.
     *
     * @param array $args
     */
    public static function dump(...$args): void
    {
        // Capture var_dump() results as string
        $dump = static::_doubleIndent(
            static::_captureDumpOfArgs($args)
        );

        // Get the caller of this function
        $caller = Caller::create();

        // Prepare view variables
        $viewVars = compact('dump', 'caller');
        $viewVars += ['isScriptLoaded' => static::$isScriptsLoadedOnHtml];

        // Rendering
        $viewName = static::_getViewName();
        $view = new View($viewName);
        $renderer = new ViewRenderer($view);
        $renderer->render($viewVars);

        if ($viewName === 'html') {
            static::setIsScriptsLoadedOnHtml(true);
        }
    }

    /**
     * @param bool $isLoaded
     */
    public static function setIsScriptsLoadedOnHtml(bool $isLoaded): void
    {
        self::$isScriptsLoadedOnHtml = $isLoaded;
    }

    /**
     * @param null|string $clientType
     */
    public static function setClient(?string $clientType): void
    {
        self::$clientType = $clientType;
    }

    /**
     * Capture var_dump() results as string.
     *
     * @param array $args
     * @return string
     */
    protected static function _captureDumpOfArgs(array $args): string
    {
        if ($args === []) {
            return 'void';
        }
        return CaptureUtil::capture(static function () use ($args) {
            foreach ($args as $arg) {
                var_dump($arg);
            }
        });
    }

    /**
     * Double the indent size to make it readable.
     *
     * @param string $str
     * @return string
     */
    protected static function _doubleIndent(string $str): string
    {
        return preg_replace_callback('/^\s++/m',
            static function ($m) {
                return str_repeat(' ', strlen($m[0]) * 2);
            },
            $str
        );
    }

    /**
     * @return string
     */
    protected static function _getViewName(): string
    {
        return (static::_getClientType() === static::CLIENT_TYPE_CLI)
            ? 'cli'
            : 'html';
    }

    /**
     * @return string
     */
    protected static function _getClientType(): string
    {
        if (static::$clientType !== null) {
            return static::$clientType;
        }
        return (PHP_SAPI === 'cli')
            ? static::CLIENT_TYPE_CLI
            : static::CLIENT_TYPE_BROWSER;
    }
}