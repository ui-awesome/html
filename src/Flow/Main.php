<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<main>` element for dominant document content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Main::tag()
 *     ->class('content')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/main
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Main extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<main>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<main>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::MAIN;
    }
}
