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

use Ymm1x\XDump\Utility\HtmlUtil;

?>
<?php if (!$isScriptLoaded): ?>
    <style>
        div.xdump-wrap {
            font-size: 100%;
            outline: 0;
            margin: 0;
            padding: 0;
            vertical-align: baseline;
            border: none;
            background: transparent;
        }

        div.xdump {
            max-height: 22em;
            overflow: scroll;
            display: inline-block;
            background: #393939;
            border: 2px solid #ea2;
            border-radius: 10px;
            margin: 5px;
            padding: 8px 5px;
            color: #e9e9e9;
            font-family: Consolas, Menlo, 'Liberation Mono', Courier, monospace, serif;
            font-size: 13px;
            font-weight: normal;
            text-align: left;
            line-height: 1.3;
        }

        div.xdump a {
            color: #ea2;
            text-decoration: underline;
        }

        div.xdump a:hover {
            color: #fb4;
        }

        div.xdump .xdump-caller {
            color: #ea2;
        }

        div.xdump .xdump-code {
            color: #cc3;
        }

        div.xdump pre {
            margin: 0;
            padding: 0 4px;
            font-size: 12px;
            line-height: 1.4;
        }
    </style>
    <script type="text/javascript">
        function setClipBoard(string) {
            var tmpDiv = document.createElement('div');
            tmpDiv.appendChild(document.createElement('pre')).textContent = string;
            tmpDiv.style.position = 'fixed';
            tmpDiv.style.left = '-100%';
            document.body.appendChild(tmpDiv);
            document.getSelection().selectAllChildren(tmpDiv);
            document.execCommand('copy');
        }
    </script>
<?php endif ?>

<div class="xdump-wrap">
    <div class="xdump">
        <span class="xdump-caller">
            <?= HtmlUtil::escape($caller->getFile()) ?>:<?= HtmlUtil::escape($caller->getLine()) ?>
        </span>
        <a href="#" onclick="setClipBoard(this.getAttribute('data-value')); return false;"
           data-value="<?= HtmlUtil::escape(basename($caller->getFile())) ?>:<?= HtmlUtil::escape($caller->getLine()) ?>">[📎Copy]</a>
        <br>
        <span class="xdump-code">&gt; <?= HtmlUtil::escape(trim($caller->getCode() ?? '')) ?></span>
        <?php // @formatter:off ?><pre><?= $dump ?></pre><?php // @formatter:on ?>
    </div>
</div>
