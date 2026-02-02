<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<header>` element for section header content.
 *
 * Provides a concrete `<header>` element implementation that returns `Block::HEADER` and inherits block-level rendering
 * and global attribute support from {@see BaseBlock}.
 *
 * The `<header>` element represents introductory content, typically a group of introductory or navigational aids.
 *
 * It may contain some heading elements but also a logo, a search form, an author name, and other elements.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Root\Header;
 *
 * echo Header::tag()
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
