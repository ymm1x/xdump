<?php
/*
 * This file is part of the Ymm1x/XDump package.
 *
 * Copyright (c) 2018 ymm1x
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var \Ymm1x\XDump\Caller $caller
 * @var bool $isScriptLoaded
 * @var string $dump
 */

?>
<?= $caller->getFile() ?>:<?= $caller->getLine() ?><?= PHP_EOL ?>
<?= $dump ?>
