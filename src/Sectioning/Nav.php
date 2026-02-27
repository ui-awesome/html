<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<nav>` element for navigation sections.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Sectioning\Nav::tag()
 *     ->class('main-menu')
 *     ->content('Navigation links here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/nav
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Nav extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<nav>` element.
     *
     * @return Block Tag enumeration instance for `<nav>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::NAV;
    }
}
