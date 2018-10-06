<?php

if (!function_exists('d')) {
    function d(...$args): void
    {
        \Ymm1x\XDump\Dumper::dump($args);
    }
} else if (!function_exists('dd')) { // Retry declare
    function dd(...$args): void
    {
        \Ymm1x\XDump\Dumper::dump($args);
    }
}

