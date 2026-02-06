<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<header>` element for section or page header content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Header::tag()
 *     ->class('page-header')
 *     ->content('Welcome to the Site')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/header
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Header extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<header>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<header>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::HEADER;
    }
}
